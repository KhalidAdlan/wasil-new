@extends('layouts.home')
@section('content')
   <div class="text-center">
       @if(isset($message))
          <span dir="rtl" class="alert alert-success">{{$message}}</span>
       @elseif(isset($error))
          <span dir="rtl" class="alert alert-danger">{{$error}}</span>
       @endif
   </div>
    <div class="top-brands">
        <div class="container">
            @foreach ($top_products->chunk(3) as $chunk)
            <div class="agile_top_brands_grids">
                @foreach($chunk  as $top_product)
                    <div class="col-md-3 top_brand_left" dir="rtl">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block" >
                                            <div class="snipcart-thumb">
                                                <a href="{!! route('product.show',$top_product->id) !!}"><img width="150" height="150" title=" " alt=" " src="{!! !isset($top_product->getPhotoAttribute()[0])? '/images/logo.jpeg': $top_product->getPhotoAttribute()[0]->url !!}" /></a>
                                                <p>{!! $top_product->name !!}</p>
                                                <h4>{!! $top_product->price !!} ج.س</h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <a class="btn btn-success" href="{!! route('cart.add',$top_product->id) !!}">اضافة للسلة</a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="clearfix"> </div>
            </div>
            @endforeach
            <div class="nav_links  text-center col-md-12">
            {{ $top_products->links() }}

            </div>
        </div>
    </div>

@stop