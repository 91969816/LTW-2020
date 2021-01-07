<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\CategoryProducts;
use Session;

use App\Http\Requests;
use App\Models\BrandProducts;
use App\Models\Products;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
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

    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product') ->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = Products::orderBy('product_id','DESC')->Paginate(10);
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout') ->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
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
            $product->save();
            $new_image = '0'.$product['product_id'].'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $product['product_image']=$new_image;
            $product->save();
            Session::put('message','Thêm danh mục sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $product['product_image']='';
        $product->save();
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        $unactive_product = Products::find($product_id);
        $unactive_product->product_status = 1;
        $unactive_product->save();
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        $active_product = Products::find($product_id);
        $active_product->product_status = 0;
        $active_product->save();

        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout') ->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = $request->all();
        $product = Products::find($product_id);
        $product->product_name = $data ['product_name'];
        $product->product_price= $data ['product_price'];
        $product->product_desc = $data ['product_desc'];
        $product->product_content= $data ['product_content'];

        $product->category_id = $data ['product_cate'];
        $product->brand_id = $data ['product_brand'];
        $product->product_status= $data ['product_status'];
        $get_image = $request->file('product_image');
        if($get_image)
        {
            $get_name_image=$get_image->getClientOriginalExtension();
            $name_image=current(explode('.',$get_name_image));
            $new_image = '0'.$product['product_id'].'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('public/uploads/product',$new_image);
            $product['product_image']=$new_image;
            $product->save();
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');
        }
        $product->save();
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        $product = Products::find($product_id);
        $product->delete();
	    Session::put('message','Xóa  sản phẩm thành công');
	    return Redirect::to('all-product');
    }

    //End Admin Page
    public function detail_product($product_id)
    {
        $cate_product = CategoryProducts::orderby('category_id','desc')->get();

        $brand_product = BrandProducts::orderby('brand_id','desc')->get();
        
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('product.show_details')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)->with('relate',$related_product);
    }

}
