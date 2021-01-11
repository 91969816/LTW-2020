@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật trạng thái giao hàng
            </header>
            <?php
                            $message = Session::get('message');
                            if($message)
                            {
                                echo $message ;
                                Session::put('message',null);
                            }
                            ?>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-order/'.$edit_order_product->order_id)}}"
                        method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input readonly type="text" value="{{$cus['customer_name']}}" name="customer_name"
                                class="form-control" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tổng tiền</label>
                            <input readonly type="text" value="{{$edit_order_product['order_total']}}"
                                name="order_total" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <input readonly type="text" value="{{$edit_order_product['order_status']}}"
                                name="order_status" class="form-control" id="exampleInputEmail1">

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn trang thái</label><br>
                            <select name="order_status" id="order_status" style="width:20%; height:35px">
                                <option value="Đang xử lý">Đang xử lý</option>
                                <option value="Đang giao hàng">Đang giao hàng</option>
                                <option value="Hoàn thành">Hoàn thành</option>
                                <option value="Hủy đơn hàng">Hủy đơn hàng</option>
                            </select>
                        </div>

                        <button type="submit" name="update_product" class="btn btn-info">Cập nhật trạng thái</button>
                    </form>
                    <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng tiền</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($order_detail as $key => $detail)
                            <tr>

                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$detail->product_name}}</td>
                                <td>{{$detail->product_sales_quantity}}</td>
                                <td>{{$detail->product_price}}</td>
                                <td>{{$detail->product_price*$detail->product_sales_quantity}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

    </div>
    </section>

    @endsection
