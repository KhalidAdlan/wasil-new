@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.salesman.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salesmen.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.id') }}
                        </th>
                        <td>
                            {{ $salesman->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.name') }}
                        </th>
                        <td>
                            {{ $salesman->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.username') }}
                        </th>
                        <td>
                            {{ $salesman->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.password') }}
                        </th>
                        <td>
                            {{ $salesman->password }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.phone') }}
                        </th>
                        <td>
                            {{ $salesman->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.commission') }}
                        </th>
                        <td>
                            {{ $salesman->commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.address') }}
                        </th>
                        <td>
                            {{ $salesman->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesman.fields.id_document') }}
                        </th>
                        <td>
                            @foreach($salesman->id_document as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salesmen.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#salesmen_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="salesmen_orders">
            @includeIf('admin.salesmen.relationships.salesmenOrders', ['orders' => $salesman->salesmenOrders])
        </div>
    </div>
</div>

@endsection