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

        <span class="float-right px-3"><button class="btn btn-primary" data-toggle='modal' data-target='#waitingLines'>Waiting Lines <span class="badge">{{$waiting_lines_count}}</span></button></span>
        <span class="float-right px-3"><button class="btn btn-primary" data-toggle='modal' data-target='#waitingProducts'>Waiting Products <span class="badge">{{$waiting_products_count}}</span></button></span>

   
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
                        Area
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="pickup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Pick Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route("admin.order.pickup") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <select name="line">
                    @foreach($lines as $line)
                      <option value="{{$line->id}}">{{$line->number}} ({{$line->driver->name}})</option>
                    @endforeach
                </select>
            </div>
            <input name="invoice_number" hidden id="modal_invoice_number" class="invoice_number" type="text"/>
            <input type="submit" class="btn btn-primary" value="Save changes"></input>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade col-md-12" id="waitingLines" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Waiting Lines</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered table-striped">
           <thead>
               <th>Line</th>
               <th>Areas</th>
               <th>Orders</th>
               <th></th>
           </thead>
           <tbody>
       @foreach ($waiting_lines as $line)
       
           <tr>
               <td>
                  <a>#{{$line->number}} ({{$line->driver->name}})</a>
               </td>
               <td>
                   @foreach (\App\Order::all()->where('line_id',$line->id)->where('status','انتظار')->pluck('customer.area') as $area)
                      {{ $area }},
                   @endforeach
               </td>
               <td>
                    {{\App\Order::all()->where('line_id',$line->id)->where('status','انتظار')->groupBy('invoice_number')->count()}}
               </td>
               <td><a class="btn btn-xs  btn-success" href="lines/{{$line->id}}" style="color:white">Show</a>

               <a href="{{route('admin.line.print',$line->id)}}" target="_blank" class="btn btn-xs  btn-success" style="color:white">Print</a>
               
               <form method="POST" action="{{ route("admin.order.change.state") }}" enctype="multipart/form-data">
            @csrf
            
            <input type="text" hidden name="line" value="{{$line->id}}"></input>
            <input type="text" hidden name="state" value="تم الشحن"></input>

             <hr>
            <input type="submit" class="btn btn-xs  btn-primary" style="color:white" value="GO!"></input>

        </form>
        </td>
           </tr>    
          

       
       @endforeach
       </tbody>
           
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="waitingProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Waiting Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
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
    serverSide: false,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.order.new-orders') }}",
    
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'invoice_number', name: 'invoice_number' },
{ data: 'status', name: 'status' },
{ data: 'customer_name', name: 'customer.name' },
{ data: 'customer.phone', name: 'customer.phone' },
{ data: 'product_name', name: 'product.name' },
{ data: 'price', name: 'price' },
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
   
}

},
{ data: 'created_at', name: 'created_at' },
{ data: 'customer.area', name: 'area' },

{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    rowGroup: {
            dataSrc: 'invoice_number',
            startRender: function ( rows, group ) {
                pickupBtn = "  <button class='btn btn-success' data-orderid='"+group+"'  data-toggle='modal' data-target='#pickup'>Pickup</button>";
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



$('#pickup').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var orderId = button.data('orderid') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  $('#modal_invoice_number').val(orderId)
})




</script>
@endsection