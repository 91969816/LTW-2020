@extends('home')
@section('content')
<section id="cart_items">
		<div class="container">
		<div class="breadcrumbs">
            <div class="breadcrumbs">
                <li>
					<a href="{{URL::to('/')}}">Trang chủ</a>
					<a href="{{URL::to('/checkout')}}">Thanh Toán Giỏ Hàng</a>
                </li>                
			</div>
        </div><!--/breadcrums-->

			<div class="register-req">
				<p>Vui lòng đăng ký để thanh toán và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-10 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form action ="{{URL::to('/save-checkout-customer')}}" method ="POST">
									{{csrf_field()}}
									<input type="text" name ="shipping_email" placeholder="Email">								
									<input type="text" name ="shipping_name" placeholder="Họ Tên">
									<input type="text" name="shipping_address" placeholder="Địa chỉ">
									<input type="text" name ="shipping_phone" placeholder="Phone">
									<textarea name ="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
									<input type="submit" value="Gửi" name="sent_order" class="btn btn-primary">
								</form>
							</div>
						</div>
					</div>										
				</div>
			</div>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>

			
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
@endsection