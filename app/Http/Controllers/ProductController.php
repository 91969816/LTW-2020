<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\CategoryProducts;
use Session;

use App\Http\Requests;
use App\Models\BrandProducts;
use App\Models\Products;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function add_product(){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product') ->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout') ->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $data = $request->all();
        $product = new Products();
        $product->product_name = $data ['product_name'];
        $product->product_price= $data ['product_price'];
        $product->product_desc = $data ['product_desc'];
        $product->product_content= $data ['product_content'];
        $product->product_image=$data['product_image'];
        $product->category_id = $data ['product_cate'];
        $product->brand_id = $data ['product_brand'];
        $product->product_status= $data ['product_status'];
        $get_image = $request->file('product_image');
        if($get_image)
        {
            $new_image = rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $product['product_image']=$new_image;
            $product->save();
            Session::put('message','Thêm danh mục sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $product['product_image']='';
        $product->save();
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-product');
    }

    public function unactive_product($product_id){
        $unactive_product = Products::find($product_id);
        $unactive_product->product_status = 1;
        $unactive_product->save();
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){

        $active_product = Products::find($product_id);
        $active_product->product_status = 0;
        $active_product->save();

        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout') ->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request,$product_id){
        $data = $request->all(); //array();
        $brand = Products::find($product_id);
        $brand->brand_name = $data ['product_name'];
        $brand->brand_desc= $data ['product_desc'];
        $brand->save();
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function delete_brand_product($brand_product_id)
    {
	DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
	Session::put('message','Xóa danh mục sản phẩm thành công');
	return Redirect::to('all-brand-product');
    }
}
