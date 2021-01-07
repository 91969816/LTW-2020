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
class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product = CategoryProducts::orderby('category_id','desc')->get();

        $brand_product = BrandProducts::orderby('brand_id','desc')->get();

        return view('checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password']=$request->customer_password;
        $data['customer_phone']=$request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect('/checkout');
    }

    public function checkout(){
        $cate_product = CategoryProducts::orderby('category_id','desc')->get();

        $brand_product = BrandProducts::orderby('brand_id','desc')->get();

        return view('checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes']=$request->shipping_notes;
        $data['shipping_address']=$request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);       
        return Redirect('/payment');
    }

    public function payment()
    {

    }

}