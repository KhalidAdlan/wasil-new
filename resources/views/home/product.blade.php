@extends('layouts.home')
@section('content')
   <div class="container center-text">
       <div class="card">
           <img style="max-width:400px" src="{!! !isset($product->getPhotoAttribute()[0])? '/images/logo.jpeg': $product->getPhotoAttribute()[0]->url !!}">
           <h2>{{$product->name}}</h2>
           <p>{{$product->description}}</p>
           <p>{{$product->price}} ج.س</p>
       </div>
   </div>

@stop