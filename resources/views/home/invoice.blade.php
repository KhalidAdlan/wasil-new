@extends('layouts.home')
@section('content')
<div class="container col-xs-10">
<div class="" dir="rtl" style="line-height:40px">

<div class="paper">
  <div>
    <h4>السيد(ة)/ {{session()->get('customer')['name']}}</h4>
    <h6>{{session()->get('customer')['area']}} | {{session()->get('customer')['address']}}</h6>
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
          @if(Session::has('cart'))    
          @foreach(Session::get('cart') as $cartItem)

            <tr>
              <td class="w-25">
                <img src="{{$cartItem['photo']}}" class="img-fluid img-thumbnail" alt="Wasiil">
              </td>
              <td>{{$cartItem['name']}}</td>
              <td>{{$cartItem['price']}}</td>
             
              <td>{{$cartItem['quantity']}}</td>
              

              <td>{{$cartItem['price'] * $cartItem['quantity']}}</td>
              
            </tr>
            @endforeach
            @endif

          </tbody>
        </table> 
        <hr>
        <div dir="ltr" class="d-flex justify-content-end">
          <table>
            <tr>
            <th></th>
            <th></th>
            <th></th>

            </tr>
            <tr>
              <td><h5 class="totalLabel">جنيه</h5></td>
              <td> <span class="price text-success">{{$totals['total']}}</span></td>
              <td><h5 class="totalLabel"> المجموع</h5></td>

            </tr>
            <tr>
            <td><h5 class="totalLabel">جنيه</h5></td>

              <td> <span class="price text-success">{{$totals['delivery']}}</span></td>
              <td><h5 class="totalLabel"> التوصيل</h5></td>

            </tr>
            <tr>
            <td><h5 class="totalLabel">جنيه</h5></td>

              <td> <span class="price text-success">{{$totals['grandTotal']}}</span></td>
              <td><h5 class="totalLabel"> المجموع الكلي</h5></td>

            </tr>
          </table>
        
        </div>
  </div>

  <div class="text-center">ملاحظة: التوصيل يتم خلال 48 ساعة منذ تأكييد طلبك*</div>

</div>
<form method='POST' action="{{route('place')}}" >
  {{@csrf_field()}}
<input type="submit" class="form-control btn btn-success" value="تأكيد الطلب"/>
</form>
</div>

</div>

@stop