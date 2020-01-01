<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSalesmanRequest;
use App\Http\Requests\UpdateSalesmanRequest;
use App\Http\Resources\Admin\SalesmanResource;
use App\Salesman;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesmenApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('salesman_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalesmanResource(Salesman::all());
    }

    public function store(StoreSalesmanRequest $request)
    {
        $salesman = Salesman::create($request->all());

        if ($request->input('id_document', false)) {
            $salesman->addMedia(storage_path('tmp/uploads/' . $request->input('id_document')))->toMediaCollection('id_document');
        }

        return (new SalesmanResource($salesman))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Salesman $salesman)
    {
        abort_if(Gate::denies('salesman_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalesmanResource($salesman);
    }

    public function update(UpdateSalesmanRequest $request, Salesman $salesman)
    {
        $salesman->update($request->all());

        if ($request->input('id_document', false)) {
            if (!$salesman->id_document || $request->input('id_document') !== $salesman->id_document->file_name) {
                $salesman->addMedia(storage_path('tmp/uploads/' . $request->input('id_document')))->toMediaCollection('id_document');
            }
        } elseif ($salesman->id_document) {
            $salesman->id_document->delete();
        }

        return (new SalesmanResource($salesman))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Salesman $salesman)
    {
        abort_if(Gate::denies('salesman_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesman->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
