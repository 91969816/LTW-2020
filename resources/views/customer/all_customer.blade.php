@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Khách Hàng
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
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th>Số điện thoại</th>           
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_customer as $key => $cus)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cus->customer_email}}</td>
            <td>{{$cus->customer_password}}</td>
            <td>{{$cus->customer_name}}</td>           
            <td><img src="public/uploads/customer/{{$cus->customer_image}}" height="100" width="100"></td>
            <td>{{$cus->customer_phone}}</td>            
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
    {{$all_customer ->links('pagination::bootstrap-4')}}
    </footer>
  </div>
</div>
@endsection
