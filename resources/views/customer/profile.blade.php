<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thông tin cá nhân</title>

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
                                 $image = Session::get('customer_image');
								 $id = Session::get('customer_id');
                                 if($name): ?>

                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                     <?php if($customer->customer_image): ?>
                                     <img alt="" src="{{URL::to('public/uploads/customer/'.$customer->customer_image)}}" height="40" width="40" >
                                        <?php else:?>
                                        <img alt="" src="{{URL::to('public/uploads/customer/no-avatar.png')}}" height="40" width="40">
                                        <?php endif;?>
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
            <p style="text-align: center;">PROFILE</p>
            <form role="form" action = "{{URL::to('/profile/'.$id)}}" method = "post" enctype="multipart/form-data">
            @csrf
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input readonly type="email" name="customer_email" class="form-control" id="inputEmail3" placeholder="Email">{{$customer->customer_email}}
            </div>
          </div>
          <div class="form-group row">
            <label  for="inputusername" class="col-sm-2 col-form-label">Họ tên</label>
            <div class="col-sm-10">
              <input type="username" value ="{{$customer->customer_name}}" name="customer_name" class="form-control" id="inputusername" placeholder="Name">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPhone" class="col-sm-2 col-form-label">Số điện thoại</label>
            <div class="col-sm-10">
              <input type="phone" value ="{{$customer->customer_phone}}" name="customer_phone" class="form-control" id="inputPhone" placeholder="Phone">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddress" class="col-sm-2 col-form-label">Địa chỉ</label>
            <div class="col-sm-10">
              <input type="text" name="customer_address" class="form-control" id="inputAddress" value ="{{$customer->customer_address}}" placeholder="Address">
            </div>
          </div>
          <div class="form-group">
                <label for="exampleInputEmail1">Ảnh đại diện</label>
                <input type="file" value="{{$customer->customer_iamge}}" name="customer_image" class = "form-control" id="exampleInputEmail1">
          </div>

          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </form>
            </div>
</div>

<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
