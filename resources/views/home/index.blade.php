@extends('layouts.home')
@section('content')
    <section class="slider">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="w3l_banner_nav_right_banner">
                        <h3>أسعارنا <span style="color:orangered">لا</span>تنافس</h3>
                        <div class="more">
                            <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="اطلب الان">اطلب الان</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3l_banner_nav_right_banner1">
                        <h3>أطلب<span style="color:orangered">الان</span>مع <span style="color:orange">واصل</span></h3>
                        <div class="more">
                            <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="اطلب الان">اطلب الان</a>
                        </div>
                    </div>
                </li>
                
            </ul>
        </div>
    </section>
    <!-- banner -->
    <div class="container-fluid">
        <img src="/images/wasil-banner.webp">
        <div class="centered">Centered</div>

    </div>
   
    <div class="top-brands">
        <div class="container">
            <h3>أفضل العروض</h3>
            <div class="slider2">
           

            @foreach ($hot_products->chunk(3) as $chunk)
            <div class="slide2">
            <div class="agile_top_brands_grids">
                @foreach($chunk as $hot_product)
                    <div class="col-md-3 top_brand_left" dir="rtl">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block" >
                                            <div class="snipcart-thumb" dir="rtl">
                                                <a href="{!! route('product.show',$hot_product->id) !!}"><img width="150" height="150" title=" " alt=" " src="{!! !isset($hot_product->getPhotoAttribute()[0])? '/images/logo.jpeg': $hot_product->getPhotoAttribute()[0]->url !!}" /></a>
                                                <p>{!! $hot_product->name !!}</p>
                                                <h4>{!! $hot_product->price !!} ج.س</h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <a class="btn btn-primary" href="{!! route('cart.add',$hot_product->id) !!}">اضافة للسلة</a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>

</div>

            @endforeach
          

                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <div class="top-brands">
        <div class="container">
            <h3>الأكثر طلبآ</h3>
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
                                                <a class="btn btn-primary" href="{!! route('cart.add',$top_product->id) !!}">اضافة للسلة</a>
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