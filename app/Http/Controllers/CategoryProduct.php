<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\BrandProducts;
use App\Models\CategoryProducts;
use App\Models\Products;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id )
        {
            return Redirect::to('dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = CategoryProducts::paginate(10);
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout') ->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){

        $this->AuthLogin();
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

        $this->AuthLogin();
        $unactive_category_product = CategoryProducts::find($category_product_id);
        $unactive_category_product->category_status = 1;
        $unactive_category_product->save();
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){

        $this->AuthLogin();
        $active_category_product = CategoryProducts::find($category_product_id);
        $active_category_product->category_status = 0;
        $active_category_product->save();

        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = CategoryProducts::find($category_product_id)->get();

        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout') ->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
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
        $this->AuthLogin();
        $category =CategoryProducts::findOrFail($category_product_id);
        $category->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin page
    public function show_category_home($category_id){
        $cate_product = CategoryProducts::where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = BrandProducts::where('brand_status','0')->orderby('brand_id','desc')->get();

        $category_by_id = Products::where('tbl_product.category_id',$category_id)->get();

        $category_name = CategoryProducts::where('tbl_category_product.category_id',$category_id)
        ->limit(1)->get();

        return view('category.show_category')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('category_by_id', $category_by_id)->with('category_name',$category_name);
    }


}
