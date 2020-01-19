<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>مرحبا بك في واصل</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Wasiil, Wasil, واصل " />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <meta name="_token" content="{{csrf_token()}}" />

    <!-- //for-mobile-apps -->
    <link rel="stylesheet" href="{!! asset('css/front.css') !!}">
    <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

</head>

<body>
<!-- header -->
<div class="agileits_header">
    <div class="w3l_offers">
        <a href="products.html">! عروض اليوم الخاصة </a>
    </div>
    <div class="w3l_search">
        <form action="#" method="post">
          <input type="submit" value=" ">
            <input type="text" name="Product" value="... أبحث في واصل " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
            
        </form>
    </div>
    <div class="product_list_header">
        <form action="#" method="post" class="last">
            <fieldset>
                <input type="hidden" name="cmd" value="_cart" />
                <input type="hidden" name="display" value="1" />
                <input type="submit" name="cart" value="سلة مشترياتك        " class="button" data-toggle="modal" data-target="#cartModal" ><span class="badge">
                  @if(Session::has('cart'))
                     {{count(Session::get('cart'))}}
                  @endif
                </span></input>
            </fieldset>
        </form>
    </div>
    <div class="w3l_header_right">
        <ul>
            <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
                <div class="mega-dropdown-menu">
                    <div class="w3ls_vegetables">
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="login.html">Login</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="w3l_header_right1">
        <h2><a href="mail.html">اتصل بنا</a></h2>
    </div>
    <div class="clearfix"> </div>
</div>

<!-- //script-for sticky-nav -->
<div class="logo_products">
    <div class="container">
        <div class="w3ls_logo_products_left">
            <h1><a href="index.html"><span>واصل الالكتروني</span> متجر</a></h1>
        </div>
        <div class="w3ls_logo_products_left1">
            <ul class="special_items">
                <li><a href="{{route('terms')}}">الشروط و الاحكام</a><i>\</i></li>
                <li><a href="{{route('about')}}">من نحن</a><i>\</i></li>
                <li><a href="/">الرئيسية</a><i>\</i></li>
                <li><a href="{{route('services')}}">خدماتنا</a></li>
            </ul>
        </div>
        <div class="w3ls_logo_products_left1">
            <ul class="phone_email">
                <li><i class="fa fa-phone" aria-hidden="true"></i>(+0123) 234 567</li>
                <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@wasil.com</a></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //header -->

<!-- banner -->
<div class="banner">
    <div class="w3l_banner_nav_left">
        <nav class="navbar nav_bottom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav nav_1">
                    
                   @foreach ($categories as $category)
                    <li><a href="{{route('category',  $category->id )}}">{{$category->name}}</a></li>
                   @endforeach
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
    {{--Dynamic Section--}}
    <div class="w3l_banner_nav_right">
            @yield('content')
    </div>
    <div class="clearfix"></div>
</div>

<!-- newsletter -->
<div class="newsletter" dir="rtl">
    <div class="container">
       
        <div class="w3agile_newsletter_right">
            <form action="#" method="post">
            <input type="submit" value="سجل الان">

                <input type="email" name="Email" value="البريد الالكتروني" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
            </form>
        </div>
        <div class="w3agile_newsletter_left">
            <h3>سجل بريدك الالكتروني معنا لتصلك اخر الاخبار</h3>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //newsletter -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div dir="rtl" class="col-md-3 w3_footer_grid">
            <h3>خريطة الموقع</h3>
            <ul class="w3_footer_grid_list">
                <li><a href="/">الرئيسية</a></li>
                <li><a href="{{route('about')}}">من نحن</a></li>
                <li><a href="{{route('terms')}}">الشروط و الأحكام</a></li>
                <li><a href="{{route('services')}}">خدماتنا</a></li>
            </ul>
        </div>
        <div dir="rtl" class="col-md-3 w3_footer_grid">
            <h3>اتصل بنا</h3>
            <ul class="w3_footer_grid_list">
                <li></li>
                <li ><i class="fa fa-phone" aria-hidden="true"></i>  <a>(+0123) 234 567</a></li>
                <li><i class="fa fa-envelope-o" aria-hidden="true"></i>  <a href="mailto:store@grocery.com">store@wasil.com</a></li>
            
            </ul>
        </div>
        <div  dir="rtl" class="col-md-3 w3_footer_grid">
            <h3>ماذا لدينا؟</h3>
            <ul class="w3_footer_grid_list">
                  @foreach ($categories as $category)
                    <li><a href="pet.html">{{$category->name}}</a></li>
                   @endforeach
               
            </ul>
        </div>

        <!-- The Modal -->
<div class="modal" id="cartModal" dir="rtl">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">سلة مشترياتك</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <table class="table table-image">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">المنتج</th>
              <th scope="col">السعر</th>
              <th scope="col"></th>
              <th scope="col">الكمية</th>
              <th scope="col"></th>

              <th scope="col">المجموع</th>
              <th scope="col"></th>
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
              <td>
                  <form method="POST" target="">
                   {{csrf_field()}}
                  <input type="submit" class="btn btn-default" value="+"/>
                  </form>
              </td>
              <td class="qty">
              <input style="max-width: 2rem;" type="text" class="form-control" id="input1" readonly value="{{$cartItem['quantity']}}"></td>
              <td>
                  <form method="POST" target="">
                   {{csrf_field()}}
                  <input type="submit" class="btn btn-default" value="-"/>
                  </form>
              </td>

              <td>{{$cartItem['price'] * $cartItem['quantity']}}</td>
              <td>
                <a href="#" class="btn btn-danger btn-sm">
                  <i class="fa fa-times"></i>
                </a>
              </td>
            </tr>
            @endforeach
            @endif

          </tbody>
        </table> 
        <div class="d-flex justify-content-end">
          <h5> المجموع<span class="price text-success"></span></h5>
        </div>
      
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
      </div>

    </div>
  </div>
</div>
<!-- End Modal -->
        <div dir="rtl" class="col-md-3 w3_footer_grid">
            <h3>منشورات الفيسبوك</h3>
            <div class="fb-page" data-href="https://web.facebook.com/Wasil-110526097088344/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://web.facebook.com/Wasil-110526097088344/" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/Wasil-110526097088344/">Wasil</a></blockquote></div>
        </div>
        <div class="clearfix"> </div>
        <div class="agile_footer_grids">
           
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h5>connect with us</h5>
                    <ul class="agileits_social_icons">
                        <li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="wthree_footer_copy">
            <p>© 2016 Wasiil. All rights reserved</p>
        </div>
    </div>
</div>
<script src="{!! asset('js/front.js') !!}"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=478121079233575&autoLogAppEvents=1"></script>

</body>
</html>