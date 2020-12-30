<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\CategoryProducts;
use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $all_category_product = CategoryProducts::all();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout') ->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $data = $request->all();
        $category = new CategoryProducts;
        $category->category_name = $data ['category_product_name'];
        $category->category_desc= $data ['category_product_desc'];
        $category->category_status = $data ['category_product_status'];
        $category->save();
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        $unactive_category_product = CategoryProducts::find($category_product_id);
        $unactive_category_product->category_status = 1;
        $unactive_category_product->save();
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
        
        $active_category_product = CategoryProducts::find($category_product_id);
        $active_category_product->category_status = 0;
        $active_category_product->save();

        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = CategoryProducts::find($category_product_id)->get();
   
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout') ->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $data = $request->all(); //array();
        $category = CategoryProducts::find($category_product_id);
        $category->category_name = $data ['category_product_name'];
        $category->category_desc= $data ['category_product_desc'];
        $category->save();
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    
    public function delete_category_product($category_product_id)
    {
	DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
	Session::put('message','Xóa danh mục sản phẩm thành công');
	return Redirect::to('all-category-product');
    }


}
