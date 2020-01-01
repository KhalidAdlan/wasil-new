<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySalesmanRequest;
use App\Http\Requests\StoreSalesmanRequest;
use App\Http\Requests\UpdateSalesmanRequest;
use App\Salesman;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SalesmenController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Salesman::query()->select(sprintf('%s.*', (new Salesman)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'salesman_show';
                $editGate      = 'salesman_edit';
                $deleteGate    = 'salesman_delete';
                $crudRoutePart = 'salesmen';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });
            $table->editColumn('password', function ($row) {
                return $row->password ? $row->password : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('id_document', function ($row) {
                if (!$row->id_document) {
                    return '';
                }

                $links = [];

                foreach ($row->id_document as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'id_document']);

            return $table->make(true);
        }

        return view('admin.salesmen.index');
    }

    public function create()
    {
        abort_if(Gate::denies('salesman_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salesmen.create');
    }

    public function store(StoreSalesmanRequest $request)
    {
        $salesman = Salesman::create($request->all());

        foreach ($request->input('id_document', []) as $file) {
            $salesman->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('id_document');
        }

        return redirect()->route('admin.salesmen.index');
    }

    public function edit(Salesman $salesman)
    {
        abort_if(Gate::denies('salesman_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salesmen.edit', compact('salesman'));
    }

    public function update(UpdateSalesmanRequest $request, Salesman $salesman)
    {
        $salesman->update($request->all());

        if (count($salesman->id_document) > 0) {
            foreach ($salesman->id_document as $media) {
                if (!in_array($media->file_name, $request->input('id_document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $salesman->id_document->pluck('file_name')->toArray();

        foreach ($request->input('id_document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $salesman->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('id_document');
            }
        }

        return redirect()->route('admin.salesmen.index');
    }

    public function show(Salesman $salesman)
    {
        abort_if(Gate::denies('salesman_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesman->load('salesmenOrders');

        return view('admin.salesmen.show', compact('salesman'));
    }

    public function destroy(Salesman $salesman)
    {
        abort_if(Gate::denies('salesman_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salesman->delete();

        return back();
    }

    public function massDestroy(MassDestroySalesmanRequest $request)
    {
        Salesman::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
