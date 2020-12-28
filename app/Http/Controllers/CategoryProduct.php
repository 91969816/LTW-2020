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
}
