<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Resources\Admin\DriverResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('driver_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DriverResource(Driver::all());
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->all());

        if ($request->input('id_document', false)) {
            $driver->addMedia(storage_path('tmp/uploads/' . $request->input('id_document')))->toMediaCollection('id_document');
        }

        return (new DriverResource($driver))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Driver $driver)
    {
        abort_if(Gate::denies('driver_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DriverResource($driver);
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->all());

        if ($request->input('id_document', false)) {
            if (!$driver->id_document || $request->input('id_document') !== $driver->id_document->file_name) {
                $driver->addMedia(storage_path('tmp/uploads/' . $request->input('id_document')))->toMediaCollection('id_document');
            }
        } elseif ($driver->id_document) {
            $driver->id_document->delete();
        }

        return (new DriverResource($driver))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Driver $driver)
    {
        abort_if(Gate::denies('driver_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
