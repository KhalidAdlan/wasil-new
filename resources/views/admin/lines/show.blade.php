@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.line.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.id') }}
                        </th>
                        <td>
                            {{ $line->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.number') }}
                        </th>
                        <td>
                            {{ $line->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.driver') }}
                        </th>
                        <td>
                            {{ $line->driver->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
    
</div>


<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.line.title') }} Assigned Orders
    </div>

    <div class="card-body">

    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Waiting <span class="badge badge-primary">{{$waitingOrders->count()}}</span></a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">On the Way <span class="badge badge-primary">{{$shippedOrders->count()}}</span></a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Delivered <span class="badge badge-primary">{{$deliveredOrders->count()}}</span></a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    
   <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
   <table class="table table-striped">
           <thead>
               <th>Customer</th>
               <th>Product</th>
               <th>Quantity</th>
               <th>Price</th>
               <th>Total</th>
           </thead>
         @foreach ($waitingOrders as $order)
          @foreach ( $order as $item)
          @if(isset($item->product))

           <tr>
           @if($loop->first)
               <td class="invoice-box" rowspan="{{$order->count()}}">
                   <h6>{{$order[0]->invoice_number}}</h6>
                   <h6>{{$order[0]->customer->name}}</h6>
                   <h6>{{$order[0]->customer->phone}}</h6>
                   <h6>{{$order[0]->customer->phone2}}</h6>
                   <h6>{{$order[0]->customer->area}}</h6>
                   <h6>{{$order[0]->customer->state}}</h6>
                   <h6>{{$order[0]->customer->address}}</h6>
                   <div class="text-center" style="border: 1px solid black; border-radius:5px"> {{$order[0]->total()}}</div>
                   
       
               </td>
            @endif
               <td>
                   {{$item->product->name}}
               </td>
               <td>
                   {{$item->quantity}}
               </td>
               <td>
                   {{$item->price}}
               </td>
               <td>
                   {{$item->price * $item->quantity}}
               </td>

           </tr>
           @endif
        @endforeach
         @endforeach
       </table>
   </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <span class="float-right px-3"><button class="btn btn-primary" data-toggle='modal' data-target='#waitingProducts'>Waiting Products (Info) <span class="badge">{{$waitingProducts->count()}}</span></button></span>

  <table class="table table-striped">
           <thead>
               <th>Customer</th>
               <th>Product</th>
               <th>Quantity</th>
               <th>Price</th>
               <th>Total</th>
               <th></th>
           </thead>
           @foreach ($shippedOrders as $order)

          @foreach ( $order as $item)
          @if(isset($item->product))
           <tr>
           @if($loop->first)
               <td class="invoice-box" rowspan="{{$order->count()}}">
                   <h6>{{$order[0]->invoice_number}}</h6>
                   <h6>{{$order[0]->customer->name}}</h6>
                   <h6>{{$order[0]->customer->phone}}</h6>
                   <h6>{{$order[0]->customer->phone2}}</h6>
                   <h6>{{$order[0]->customer->area}}</h6>
                   <h6>{{$order[0]->customer->state}}</h6>
                   <h6>{{$order[0]->customer->address}}</h6>
                   <div class="text-center" style="border: 1px solid black; border-radius:5px"> {{$order[0]->total()}}</div>

                   <form method="POST" action="{{ route("admin.order.change.state") }}" enctype="multipart/form-data">
            @csrf
            
            <input type="text" hidden name="line" value="{{$order[0]->line_id}}"></input>

            <input type="text" hidden name="invoice_number" value="{{$order[0]->invoice_number}}"></input>
            <input type="text" hidden name="state" value="تم التوصيل"></input>

             <hr>
            <input type="submit" class="btn btn-xs  btn-primary" style="color:white" value="Finish!"></input>

        </form>
               </td>
            @endif
               <td>
                   {{$item->product->name}}
               </td>
               <td>
                   {{$item->quantity}}
               </td>
               <td>
                   {{$item->price}}
               </td>
               <td>
                   {{$item->price * $item->quantity}}
               </td>
               <td>
                   <form method="POST" action="{{route('admin.order.delete',$item->id)}}" enctype="multipart/form-data">
                   @method('DELETE')
                   @csrf
                       <input value="Delete" type="submit" class="btn btn-xs btn-danger"></input>
                   </form>
               </td>

           </tr>
           @endif
        @endforeach
         @endforeach
       </table>



<div class="modal fade" id="waitingProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Waiting Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id='DivIdToPrint' class="modal-body">
          <h2>
              {{$line->number}} | {{$line->driver->name}}
          </h2>
          <h6>
              {{now()}}
          </h6>
          <input class="btn btn-xs btn-primary float-right" type="submit" value="Print" onclick='printDiv();'></input>
          <br>
      <table class="table table-bordered">
           <thead>
               <td>Product</td>
               <td>Quantity</td>
               <td>Price</td>
               <td>Total</td>
               <th></th>

           </thead>
           <tbody>
               @foreach($waitingProducts as $waitingProduct)
               <tr>
                 <td>{{(\App\Product::find($waitingProduct[0]->product_id))['name']}}</td>
                 <td>{{ $waitingProduct->sum(function($order){return $order['quantity'];})}}</td>
                 <td>{{$waitingProduct[0]->price}}</td>
                 <td>{{$waitingProduct->sum(function($order){return $order['quantity'];}) * $waitingProduct[0]->price}}</td>
                 <td></td>            
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
  </div>

  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  <table class="table table-striped">
           <thead>
               <th>Customer</th>
               <th>Product</th>
               <th>Quantity</th>
               <th>Price</th>
               <th>Total</th>
           </thead>
        @foreach ($deliveredOrders as $order)

          @foreach ( $order as $item)
          @if(isset($item->product))

           <tr>
           @if($loop->first)
               <td class="invoice-box" rowspan="{{$order->count()}}">
                   <h6>{{$order[0]->invoice_number}}</h6>
                   <h6>{{$order[0]->customer->name}}</h6>
                   <h6>{{$order[0]->customer->phone}}</h6>
                   <h6>{{$order[0]->customer->phone2}}</h6>
                   <h6>{{$order[0]->customer->area}}</h6>
                   <h6>{{$order[0]->customer->state}}</h6>
                   <h6>{{$order[0]->customer->address}}</h6>
                   <div class="text-center" style="border: 1px solid black; border-radius:5px"> {{$order[0]->total()}}</div>


               </td>
            @endif
               <td>
                   {{$item->product->name}}
               </td>
               <td>
                   {{$item->quantity}}
               </td>
               <td>
                   {{$item->price}}
               </td>
               <td>
                   {{$item->price * $item->quantity}}
               </td>

           </tr>
           @endif
        @endforeach
         @endforeach
       </table>
  </div>
</div>




       
    </div>
    
</div>

<script>
    function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();
  var css = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding:0.5em;' +
        '}' +
        '</style>';

  newWin.document.write('<html>'+css+'<body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
    </script>



@endsection