<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\CategoryProducts;
use Session;
use Cart;
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
        $data['customer_password']=md5($request->customer_password);
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
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes']=$request->shipping_notes;
        $data['shipping_address']=$request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);       
        return Redirect::to('/payment');
    }

    public function payment(){
        $cate_product = CategoryProducts::orderby('category_id','desc')->get();
        $brand_product = BrandProducts::orderby('brand_id','desc')->get();

        return view('checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function order_place(Request $request){
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_data_details = array();
            $order_data_details['order_id'] = $order_id;
            $order_data_details['product_id'] = $v_content->id;
            $order_data_details['product_name'] = $v_content->name;
            $order_data_details['product_price'] = $v_content->price;
            $order_data_details['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_data_details);
        }
        if($data['payment_method']==1){
            echo 'Thanh toán bằng ATM';
        }elseif($data['payment_method']==2){
            echo 'Thanh toán bằng tiền mặt';
        }
        else{
            echo 'Thanh toán bằng momo';
        }
        //return Redirect('/payment');
    }

}