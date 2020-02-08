@extends('layouts.home')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{Session::get('success')}}</strong> 
</div>
@endif

@if(isset($message))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{$message}}</strong> 
</div>
@endif

@if(isset($success))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{$success}}</strong> 
</div>
@endif
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
        <div class="centered">
            
     متعة التسوق مع واصل 
     
    </div>

    </div>

    
   
    <div class="top-brands">
    
        <div class="container">
            <h3>أفضل العروض</h3>
            <br>
            <div class="">
  
  <div class="row">
    <div class="col-md-10">
      <div class="carousel slide multi-item-carousel" id="theCarousel">
        <div class="carousel-inner">

          @for(  $i = 0; $i< count($hot_products); $i++)
          <div class="item {{$i == 0? 'active' : ''}}">
            <div class="col-md-4">
            <div class=" top_brand_left" dir="rtl">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block" >
                                            <div class="snipcart-thumb" dir="rtl">
                                                <a href="{!! route('product.show',$hot_products[$i]->id) !!}"><img width="150" height="150" title=" " alt=" " src="{!! !isset($hot_products[$i]->getPhotoAttribute()[0])? '/images/logo.jpeg': $hot_products[$i]->getPhotoAttribute()[0]->url !!}" /></a>
                                                <p>{!! $hot_products[$i]->name !!}</p>
                                                <h4>{!! $hot_products[$i]->price !!} ج.س</h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                            <form method="post" action="{{route('cart.add',$hot_products[$i]->id)}}">
                                               {{csrf_field()}}
                                              <input type="submit" value="اضافة للسلة" class="btn btn-success">
                                            </input>
                                            </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
          </div>
          @endfor
          
          <!--  Example item end -->
        </div>
        <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
      </div>
    </div>
  </div>
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
                                            <form method="post" action="{{route('cart.add',$top_product->id)}}">
                                               {{csrf_field()}}
                                              <input type="submit" value="اضافة للسلة" class="btn btn-success">
                                            </input>
                                            </form>                                            </div>
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




    <style>
        .multi-item-carousel{
  .carousel-inner{
    > .item{
      transition: 500ms ease-in-out left;
    }
    .active{
      &.left{
        left:-33%;
      }
      &.right{
        left:33%;
      }
    }
    .next{
      left: 33%;
    }
    .prev{
      left: -33%;
    }
    @media all and (transform-3d), (-webkit-transform-3d) {
      > .item{
        // use your favourite prefixer here
        transition: 500ms ease-in-out left;
        transition: 500ms ease-in-out all;
        backface-visibility: visible;
        transform: none!important;
      }
    }
  }
  .carouse-control{
    &.left, &.right{
      background-image: none;
    }
  }
}

.centered{
color:#FEF300;
text-shadow: 1px 1px #f00;

font-size:2.5em;
}


        </style>

        <script>
        
        // Instantiate the Bootstrap carousel
$('.multi-item-carousel').carousel({
  interval: false
});

// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
$('.multi-item-carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
  } else {
  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  }
});
        </script>

@stop