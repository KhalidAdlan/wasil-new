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
           @endif
        @endforeach
         @endforeach
       </table>
   </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
               <td rowspan="{{$order->count()}}">
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
                   {{$item->product->price}}
               </td>
               <td>
                   {{$item->product->price * $item->quantity}}
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
           @endif
        @endforeach
         @endforeach
       </table>
  </div>
</div>




       
    </div>
    
</div>



@endsection