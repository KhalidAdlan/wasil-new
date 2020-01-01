<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLineRequest;
use App\Http\Requests\UpdateLineRequest;
use App\Http\Resources\Admin\LineResource;
use App\Line;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LineApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LineResource(Line::with(['driver'])->get());
    }

    public function store(StoreLineRequest $request)
    {
        $line = Line::create($request->all());

        return (new LineResource($line))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Line $line)
    {
        abort_if(Gate::denies('line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LineResource($line->load(['driver']));
    }

    public function update(UpdateLineRequest $request, Line $line)
    {
        $line->update($request->all());

        return (new LineResource($line))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Line $line)
    {
        abort_if(Gate::denies('line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $line->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
