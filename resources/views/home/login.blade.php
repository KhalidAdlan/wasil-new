@extends('layouts.home')
@section('content')
<div class="container col-xs-10">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="text-center" dir="rtl" style="line-height:40px">
<form action="{{route('portal.login.submit')}}" method="POST" enctype="multipart/form-data">
  {{@csrf_field()}}
<h3 >تسجيل الدخول</h3>
<div class="form-group">
  <label for="username">الاسم</label>
  <input class="form-control" type="text" name="username" placeholder="اسم المستخدم"/>
</div>



<div class="form-group">
  <label for="password">كلمة المرور</label>
  <input class="form-control" type="password" name="password" placeholder="كلمة المرور"/>
</div>

<div class="form-group">
  <input class="form-control btn btn-success col-6" type="submit" name="submit" value="تسجيل الدخول"/>
</div>

</form>
</div>

</div>






@stop