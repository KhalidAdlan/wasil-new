<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLineRequest;
use App\Http\Requests\StoreLineRequest;
use App\Http\Requests\UpdateLineRequest;
use App\Line;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LineController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Line::with(['driver'])->select(sprintf('%s.*', (new Line)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'line_show';
                $editGate      = 'line_edit';
                $deleteGate    = 'line_delete';
                $crudRoutePart = 'lines';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : "";
            });
            $table->addColumn('driver_name', function ($row) {
                return $row->driver ? $row->driver->name : '';
            });

            $table->editColumn('driver.phone', function ($row) {
                return $row->driver ? (is_string($row->driver) ? $row->driver : $row->driver->phone) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'driver']);

            return $table->make(true);
        }

        return view('admin.lines.index');
    }

    public function create()
    {
        abort_if(Gate::denies('line_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lines.create', compact('drivers'));
    }

    public function store(StoreLineRequest $request)
    {
        $line = Line::create($request->all());

        return redirect()->route('admin.lines.index');
    }

    public function edit(Line $line)
    {
        abort_if(Gate::denies('line_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $line->load('driver');

        return view('admin.lines.edit', compact('drivers', 'line'));
    }

    public function update(UpdateLineRequest $request, Line $line)
    {
        $line->update($request->all());

        return redirect()->route('admin.lines.index');
    }

    public function show(Line $line)
    {
        abort_if(Gate::denies('line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $line->load('driver');

        return view('admin.lines.show', compact('line'));
    }

    public function destroy(Line $line)
    {
        abort_if(Gate::denies('line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $line->delete();

        return back();
    }

    public function massDestroy(MassDestroyLineRequest $request)
    {
        Line::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}