@extends('layouts.admin')
@section('content')
@can('order_create')



    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.orders.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Order">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    
                    <th>
                        {{ trans('cruds.order.fields.invoice_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.customer') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.salesmen') }}
                    </th>
                    <th>
                        {{ trans('cruds.salesman.fields.created_at') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.orders.index') }}",
    initComplete: function () {
            this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                    column.cells('', column[0]).render('display').sort().unique().each( function ( d, j ){
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'invoice_number', name: 'invoice_number' },
{ data: 'status', name: 'status' },
{ data: 'customer_name', name: 'customer.name' },
{ data: 'customer.phone', name: 'customer.phone' },
{ data: 'product_name', name: 'product.name' },
{ data: 'product.price', name: 'product.price' },
{ data: 'quantity', name: 'quantity' },

{ data: 'salesmen_name', name: 'salesmen.name' , render: function(data){
    if(data != '')
    {
        var data     = data.replace( /&quot;/g, '"' ),
    jsonData = jQuery.parseJSON( data );

      

        
    return "<a href='/admin/salesmen/"+jsonData.id+"'>" + jsonData.name + "</a>";

    }
    else
    {
        return '';
    }
   
}},
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    rowGroup: {
            dataSrc: 'invoice_number',
            startRender: function ( rows, group ) {
                pickupBtn = "  <a class='btn btn-success' href='#'>Pickup</a>";
                cancelBtn = "  <a class='btn btn-danger' href='#'>Cancel</a>";
                showBtn = "  <a class='btn btn-primary' href='#'>Show</a>";

            return "<span class='invoice'>"+group +"</span> "+pickupBtn+" "+showBtn+" "+cancelBtn;
        }
        }
  };
  $('.datatable-Order').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();

       
    });
});








</script>
@endsection