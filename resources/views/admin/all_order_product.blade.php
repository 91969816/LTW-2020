@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Order sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <?php
                            $message = Session::get('message');
                            if($message)
                            {
                                echo $message ;
                                Session::put('message',null);
                            }
                            ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @csrf
          @foreach($all_product_order as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            @foreach($all_customer as $key => $cus)
            <?php if($cus->customer_id == $pro->customer_id):?>
            <td>{{$cus->customer_name}}</td>
            <td>{{$cus->customer_address}}</td>
            <td>{{$cus->customer_phone}}</td>
            <td>{{$cus->customer_email}}</td>
            <?php endif;?>
            @endforeach
            <td>{{$pro->order_total}}</td>
            <td>{{$pro->order_status}}</td>
            <td><span class="text-ellipsis">
            </span></td>
            <td>

              <a href="{{URL::to('/edit-order/'.$pro->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn không?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>

          @endforeach
        </tbody>
      </table>
    </div>




    <footer class="panel-footer">

    {{$all_product_order ->links('pagination::bootstrap-4')}}
    </footer>
  </div>
</div>
@endsection
