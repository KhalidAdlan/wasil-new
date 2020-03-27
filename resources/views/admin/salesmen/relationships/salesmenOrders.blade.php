


<div class="m-3">
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
        <p id="date_filter">
    <span id="date-label-from" class="date-label">From: </span><input class="date" value="2020-02-2" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:<input class="date" type="text" value="2020-02-5" id="datepicker_to" />
</p>

        <div class="card-body">
            <div class="table-responsive">
                <table id="ordersTable" class=" table table-bordered table-striped table-hover datatable datatable-Order">
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
                                {{ trans('cruds.product.fields.quantity' )}}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.price') }}
                            </th>
                            <th>
                                 Total
                            </th>
                            <th>
                                Commission
                            </th>
                            <th>
                                Created At
                            </th>
                           
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
		               <tr>
		             	
                         <td colspan="6">Totals</td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>

                         <td></td>

		               </tr>
	               </tfoot>
                    <tbody>
                        @foreach($orders as $key => $order)
                        @if(isset($order->product))
                            <tr data-entry-id="{{ $order->id }}">
                                <td>

                                </td>
                                
                                <td>
                                    {{ $order->invoice_number ?? '' }}
                                </td>
                                <td>
                                    {{ $order->status ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $order->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->quantity ?? ''}}
                                </td>
                                <td>
                                    {{ $order->price ?? '' }}
                                </td>
                                <td>
                                    {{ $order->quantity * $order->price }}
                                </td>
                                <td>
                                {{ ($order->price - $order->product->cost_price) * $order->quantity * \App\Salesman::find($order->salesmen_id)->commission /100}}

                                </td>
                               
                                <td>
                                    {{ $order->created_at}}
                                </td>
                                
                                <td>
                                    @can('order_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('order_delete')
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                                

                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
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

        footerCallback: function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols = api.columns().nodes().length;
				var j = 8;
				while(j < nb_cols - 2){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
					j++;
				} 
			},
		
	
    
   
   
  });
   $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})







  

</script>
<script type="text/javascript">

// The plugin function for adding a new filtering routine
$.fn.dataTableExt.afnFiltering.push(
    function(oSettings, aData, iDataIndex){
        var dateStart = parseDateValue($("#datepicker_from").val());
        var dateEnd = parseDateValue($("#datepicker_to").val());
        // aData represents the table structure as an array of columns, so the script access the date value
        // in the first column of the table via aData[0]
        var evalDate= parseDateValue(aData[10]);
        if (evalDate >= dateStart && evalDate <= dateEnd) {
            return true;
        }
        else {
            return false;
        }

    });

// Function for converting a mm/dd/yyyy date value into a numeric string for comparison (example 08/12/2010 becomes 20100812
function parseDateValue(rawDate) {
    var dateArray= rawDate.split("-");
    var parsedDate= dateArray[0] + dateArray[1] + dateArray[2];
    return parsedDate;
}




    // The dataTables plugin creates the filtering and pagination controls for the table dynamically, so these
    // lines will clone the date range controls currently hidden in the baseDateControl div and append them to
    // the feedbackTable_filter block created by dataTables
    // $dateControls= $("#baseDateControl").children("div").clone();
    // $("#feedbackTable_filter").prepend($dateControls);

    // Implements the jQuery UI Datepicker widget on the date controls
   

    // Create event listeners that will filter the table whenever the user types in either date range box or
    // changes the value of either box using the Datepicker pop-up calendar
    //$("#datepicker_from").keyup ( function() {  $($.fn.dataTable.tables(true)).DataTable().fnDraw(); } );
    $('#datepicker_from').on("dp.change", function (e) {
        $($.fn.dataTable.tables(true)).DataTable().draw();
});
$('#datepicker_to').on("dp.change", function (e) {
    $($.fn.dataTable.tables(true)).DataTable().draw();
        });
    /*$("#datepicker_from").datepicker( {
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText){
      alert(dateText);
    }});
    */
 //   $("#datepicker_to").keyup ( function() {  $($.fn.dataTable.tables(true)).DataTable().fnDraw(); } );
  //  $("#datepicker_to").change( function() {  $($.fn.dataTable.tables(true)).DataTable().fnDraw(); } );


</script>


@endsection