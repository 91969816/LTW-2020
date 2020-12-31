<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\CategoryProducts;
use Session;

use App\Http\Requests;
use App\Models\BrandProducts;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $all_brand_product = BrandProducts::all();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout') ->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $data = $request->all();
        $brand = new BrandProducts;
        $brand->brand_name = $data ['brand_product_name'];
        $brand->brand_desc= $data ['brand_product_desc'];
        $brand->brand_status = $data ['brand_product_status'];
        $brand->save();
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id){
        $unactive_brand_product = BrandProducts::find($brand_product_id);
        $unactive_brand_product->brand_status = 1;
        $unactive_brand_product->save();
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        
        $active_brand_product = BrandProducts::find($brand_product_id);
        $active_brand_product->brand_status = 0;
        $active_brand_product->save();

        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $edit_brand_product = BrandProducts::find($brand_product_id)->get();
   
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout') ->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $data = $request->all(); //array();
        $brand = BrandProducts::find($brand_product_id);
        $brand->brand_name = $data ['brand_product_name'];
        $brand->brand_desc= $data ['brand_product_desc'];
        $brand->save();
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    
    public function delete_brand_product($brand_product_id)
    {
	DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
	Session::put('message','Xóa danh mục sản phẩm thành công');
	return Redirect::to('all-brand-product');
    }
}
