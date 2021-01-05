<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Pet-Shop</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +84 222 777 888</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> petshopCat@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/')}}"><img src="{{URL::to('public/frontend/images/pet-shop-logo.jpg')}}" class="img-responsive" alt="" style="width:150px;height:150px;"/></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-question"></i> Trợ Giúp</a></li>
								<li><a href="#"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php
								 $name = Session::get('customer_name');
								 
								 $id = Session::get('customer_id');
                                 if($name): ?>

                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <img alt="" src="{{('public/backend/images/2.png')}}">
                                        <span class="username">
                                        <?php

                                            echo $name ;
                                        ?>
                                        </span>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu extended logout">
                                        <li><a href="{{URL::to('profile/'.$id)}}"><i class=" fa fa-suitcase"></i>Profile</a></li>                                       
                                        <li><a href="{{URL::to('logout')}}"><i class="fa fa-key"></i>Đăng Xuất</a></li>
                                    </ul>
                                </li>
                                <?php else: ?>
								<li><a href="{{URL::to('login')}}"><i class="fa fa-sign-in"></i> Đăng Nhập</a></li>
                                <li><a href="{{URL::to('register')}}"><i class="fa fa-sign-in"></i> Đăng Ký</a></li>
                                <?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/')}}" class="active">Trang Chủ</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Diễn Đàn<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Cách Chăm Sóc Mèo</a></li>
										<li><a href="#">Tìm Hiểu Về Mèo</a></li>
                                    </ul>
                                </li>

								<li><a href="contact-us.html">Liên Hệ | Đặt Hàng</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="{{URL::to('/tim-kiem')}}" method="post">
							{{csrf_field()}}			
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm Kiếm"/>
								<input type="submit" style="margin-top:0;color:black" name="search_items" class="btn btn-primary btn-sm" value="Tìm Kiếm">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-10">
									<h1><span>Mèo Bangdal</span></h1>
									<img src="{{URL::to('imagesCat/meo-bengal.jpg')}}" class="girl img-responsive" alt="" />
									<p>Xuất hiện vào thế kỷ 19 ở Mỹ, mèo Bengal là kết quả lai chéo giữa mèo nhà Mỹ và mèo báo châu Á. Cái tên “Bengal” lấy họ từ mèo Felis Bengalensis và giống mèo này được phát triển giống những loài mèo hoang, mèo rừng như: Mèo gấm ocelots, báo hoa mai, báo gấm, mèo đốm margays.</p>
									<button type="button" class="btn btn-default get">Thông Tin Sản Phẩm</button>
								</div>
							</div>
							<div class="item">
								<div class="col-sm-10">
									<h1><span>Mèo Ragdoll</span></h1>
                                    <img src="{{URL::to('imagesCat/meo-ragdoll.jpg')}}" class="girl img-responsive" alt="" />
									<p>Mèo Ragdoll là tên một giống mèo với đôi mắt màu xanh dương và bộ lông hai màu tương phản đặc trưng. Nó là giống mèo to lớn, với cơ bắp rắn chắc và bộ lông mềm mại và hơi dài.Chúng cũng được biết đến là giống mèo hiền lành, dễ bảo và dễ thương. Mèo Ragdoll được một người gây giống Hoa Kỳ tên là Ann Baker phát triển, và cái tên Ragdoll xuất phát từ thói quen rũ người ra và thả lỏng cơ thể khi được bế lên của các cá thể mèo đời đầu tiên.</p>
									<button type="button" class="btn btn-default get">Thông Tin Sản Phẩm</button>
								</div>
							</div>

							<div class="item">
								<div class="col-sm-10">
								<h1><span>Mèo Sphynx</span></h1>
									<img src="{{URL::to('imagesCat/meo-Sphynx.jpg')}}" class="girl img-responsive" alt="" />
									<p>Người ta gọi mèo Sphynx là mèo Ai Cập không phải vì Sphynx có nguồn gốc từ mảnh đất sinh ra các Pharaoh mà bởi vì ngoại hình của nó. Ban đầu người ta chỉ gọi là mèo không lông. Nhưng vì ngoại hình của chúng khá giống với bức tượng nhân sư ở Ai Cập nên cái tên mèo Ai Cập, mèo nhân sư ra đời.</p>
									<button type="button" class="btn btn-default get">Thông Tin Sản Phẩm</button>
								</div>
							</div>



						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$cate->category_name}}
										</a>
									</h4>
								</div>
							</div>
						@endforeach
						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($brand as $key=>$brand)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">
									<span class="pull-right">(50)</span>{{$brand->brand_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->

					</div>
				</div>
				<!--CODE HIEN THI SAN PHAM-->
				<div class="col-sm-9 padding-right">
						@yield('content')

				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->

		 <!-- <div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>  -->
		<div class="footer-widgets tp_footer">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="hotline-box col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="hotline-contact">
						<p style="text-align:center;">
							<span style="font-size:15px;">
								<span style="font-size:15px;">
									<strong>
										<span style="color:#FFFFFF;"><span style="text-align:center;text-indent:10px;">MUA HÀNG TRỰC TUYẾN</span></span>
									</strong>
								</span><br style="font-size:15px;text-align:center;text-indent:10px;">
								<strong>
									<span style="font-size:16px;">
										<span style="color:#FFFFFF;"><span style="text-align:center;text-indent:10px;">1900 633 501 - 1</span></span>
									</span>
								</strong>
								<br style="font-size:15px;text-align:center;text-indent:10px;">
								<a style="font-size:15px;text-align:center;text-indent:10px;">
									<strong>
										<span>sale.petshop@gmail.com</span>
									</strong>
								</a>
							</span>
						</p>
					</div>
				</div>

				<div class="hotline-box col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="hotline-contact">
						<p style="text-align:center;">
							<span style="font-size:15px;">
								<span style="font-size:15px;">
									<strong>
										<span style="color:#FFFFFF;"><span style="text-align:center;text-indent:10px;">CHĂM SÓC KHÁCH HÀNG</span></span>
									</strong>
								</span><br style="font-size:15px;text-align:center;text-indent:10px;">
								<strong>
									<span style="font-size:16px;">
										<span style="color:#FFFFFF;"><span style="text-align:center;text-indent:10px;">1900 633 501 - 2</span></span>
									</span>
								</strong><br style="font-size:15px;text-align:center;text-indent:10px;">
								<a style="font-size:15px;text-align:center;text-indent:10px;">
									<strong>
										<span>cskh.petshop@gmail.com</span>
									</strong>
								</a>
							</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="container">
							<div class="row">
								<span style="color:#FFFFFF;">
									<span style="text-align:center;text-indent:10px;">
										<strong>
											<p>Địa chỉ 1824 Lê Văn Lương Xã Nhơn Đức , Huyện Nhà Bè , TP.Hồ Chí Minh<p>
										</strong>
									</span>
								</span>	<!-- <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p> -->
							</div>
				</div>
			</div>
		</div>
	</footer>



    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>
</html>
