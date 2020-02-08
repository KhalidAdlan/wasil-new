@extends('layouts.home')
@section('content')
<div class="container col-xs-10">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="text-center" dir="rtl" style="line-height:40px">
<h3>{{session()->get('salesman')->name}}</h3>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
       
            @foreach($orders as $order)
                  
            <div class="paper">
  <div>
    <h4>السيد(ة)/ {{$order[0]->customer->name}}</h4>
    <h6>{{$order[0]->customer->state}} | {{$order[0]->customer->area}} | {{$order[0]->customer->address}}</h6>
    <h6>{{$order[0]->customer->phone}} | {{$order[0]->customer->phone2}}</h6>
    <hr/>
  </div>
  <div class="card">
  <table class="table table-image">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">المنتج</th>
              <th scope="col">السعر</th>
              <th scope="col">الكمية</th>

              <th scope="col">المجموع</th>
            </tr>
          </thead>
          <tbody>
          @foreach($order as $cartItem)

            <tr>
              <td class="w-25">
                <img src="{{$cartItem->product->getPhotoAttribute()[0]->thumbnail}}" class="img-fluid img-thumbnail" alt="Wasiil">
              </td>
              <td>{{$cartItem->product->name}}</td>
              <td>{{$cartItem->product->price}}</td>
             
              <td>{{$cartItem->quantity}}</td>
              

              <td>{{$cartItem->quantity * $cartItem->product->price }}</td>
              
            </tr>
            @endforeach

          </tbody>
        </table> 
        
        
  </div>

 

</div>

</div>
<br><br>
                   
                   
               
              @endforeach
           
</div>

</div>

</div>








@stop