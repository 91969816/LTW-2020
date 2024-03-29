<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use App\Models\BrandProducts;
use App\Models\CategoryProducts;
use App\Models\Products;

use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
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
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = BrandProducts::paginate(10);
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout') ->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
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
        $this->AuthLogin();
        $unactive_brand_product = BrandProducts::find($brand_product_id);
        $unactive_brand_product->brand_status = 1;
        $unactive_brand_product->save();
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id){

        $this->AuthLogin();
        $active_brand_product = BrandProducts::find($brand_product_id);
        $active_brand_product->brand_status = 0;
        $active_brand_product->save();

        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){

        $this->AuthLogin();
        $edit_brand_product = BrandProducts::find($brand_product_id)->get();

        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout') ->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){

        $this->AuthLogin();
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
        $this->AuthLogin();
        $brand = BrandProducts::findOrFail($brand_product_id);
        $brand->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page
    public function show_brand_home($brand_id){
        $cate_product =  CategoryProducts::where('category_status',0)->orderby('category_id','desc')->get();

        $brand_product =BrandProducts::where('brand_status','0')->orderby('brand_id','desc')->get();

        $brand_by_id =Products::where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = BrandProducts::where('tbl_brand.brand_id',$brand_id)->limit(1)->get();

        return view('brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('brand_by_id', $brand_by_id)->with('brand_name',$brand_name);
    }
}
