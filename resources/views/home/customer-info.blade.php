@extends('layouts.home')
@section('content')
<div class="container col-xs-10">
<div class="text-center" dir="rtl" style="line-height:40px">
<form action="{{route('customer.store')}}" method="POST">
  {{@csrf_field()}}
<h3 >بياناتك الشخصية</h3>
<div class="form-group">
  <label for="name">الاسم</label>
  <input class="form-control" type="text" name="name" placeholder="اكتب اسمك كاملا"/>
</div>
<div class="form-group">
  <label for="phone">الهاتف</label>
  <input class="form-control" type="text" name="phone" placeholder="اكتب رقم هاتفك"/>
</div>
<div class="form-group">
  <select class="form-control" name="area">
    <option value="-1">اختر المنطقة</option>
    <option value="بحري">بحري</option>
    <option value="امدرمان">امدرمان</option>
    <option value="الخرطوم">الخرطوم</option>   
    <option value="الولايات">الولايات</option>
  </select>
</div>
<div class="form-group">
  <label for="address">العنوان</label>
  <input class="form-control" type="text" name="address" placeholder=""/>
</div>

<div class="form-group">
  <input class="form-control btn btn-success col-6" type="submit" name="submit" value="التالي"/>
</div>

</form>
</div>

</div>

@stop