@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="invoice_number">{{ trans('cruds.order.fields.invoice_number') }}</label>
                <input class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}" type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number', '') }}" required>
                @if($errors->has('invoice_number'))
                    <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.invoice_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.order.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', 'Ordered') }}" required>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_id">{{ trans('cruds.order.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $customer)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $customer }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer_id'))
                    <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.order.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_id'))
                    <span class="text-danger">{{ $errors->first('product_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="salesmen_id">{{ trans('cruds.order.fields.salesmen') }}</label>
                <select class="form-control select2 {{ $errors->has('salesmen') ? 'is-invalid' : '' }}" name="salesmen_id" id="salesmen_id">
                    @foreach($salesmens as $id => $salesmen)
                        <option value="{{ $id }}" {{ old('salesmen_id') == $id ? 'selected' : '' }}>{{ $salesmen }}</option>
                    @endforeach
                </select>
                @if($errors->has('salesmen_id'))
                    <span class="text-danger">{{ $errors->first('salesmen_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.salesmen_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection