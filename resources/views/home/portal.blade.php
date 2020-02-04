@extends('layouts.home')
@section('content')
<div class="container col-xs-10">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="text-center" dir="rtl" style="line-height:40px">
<h3>{{session()->get('salesman')->name}}</h3>
</div>

</div>






@stop