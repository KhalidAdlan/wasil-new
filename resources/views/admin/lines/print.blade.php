@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.line.title_singular') }} #{{$line->number}} ({{$line->driver->name}})
        <button class="btn btn-success float-right">
              Print
        </button>
    </div>

    
    
</div>


<div class="card">
  
    <div class="card-body">
       <table class="table table-striped">
           <thead>
               <th>Customer</th>
               <th>Product</th>
               <th>Quantity</th>
               <th>Price</th>
               <th>Total</th>
           </thead>
         @foreach ($orders as $order)

          @foreach ( $order as $item)
           <tr>
           @if($loop->first)
               <td rowspan="{{$order->count()}}">
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
                   {{$item->product->price}}
               </td>
               <td>
                   {{$item->product->price * $item->quantity}}
               </td>

           </tr>
        @endforeach
         @endforeach
       </table>
    </div>
    
</div>



@endsection