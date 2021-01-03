<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
class CustomersController extends Controller
{

    public function AuthLogin()
    {
        $customer_id = Session::get('customer_id');
        if($customer_id)
        {
            return Redirect::to('home');
        }else{
           return Redirect::to('login')->send();
        }
    }


    public function index_login ()
    {
        return view('login');
    }
    public function index_register ()
    {


        return view('register');
    }

    public function login(Request $request){

        $data = $request->all();
        $customer = Customers::where('customer_email',$data['customer_email'])->first();

        if(!$customer)
        {
            Session::put('message','Tài khoản sai!!!');
            return Redirect::to('login');
        }
       if(md5($data['customer_password'])==$customer->customer_password)
       {
        Session::put('customer_name', $customer->customer_name);
        Session::put('customer_id',$customer->customer_id);
        return Redirect::to('/');
       }else{
            Session::put('message','Sai mat khau !!!');
            return Redirect::to('login');
        }

    }

//     public function findByEmail($email)
//    {
//        $customers = customers::where('customers_email',$email)->first();
//        return $customers;
//    }

    public function verify(Request $request ){

        $data= $request->all();
        $code = $data['token'];
        $customer = Customers::find($data['id']);
        if($customer['customer_token'])
        {
            if($customer['customer_token']==$code)
            {
                $customer->customer_token =null;
                $customer->save();
                Session::put('customer_name', $customer->customer_name);
                Session::put('customer_id',$customer->customer_id);
                return Redirect::to('/');
            }
            else{
                $error = 'Tài khoản không tồn tại ';
            }
        }
        else{
            $error = 'Tài khoản không tồn tại ';
        }

    }
    public function save_register_list(Request $request)
    {

        $data = $request->all();
        $customers = new Customers();
        $customers = Customers::where('customer_email',$data['customers_email'])->first();
        if($customers==null)
        {

            $code =strtoupper(bin2hex(random_bytes(4)));
            $customers =new Customers();
            $customers ->customer_email = $data['customers_email'];
            $customers ->customer_password = md5($data['customers_password']);
            $customers ->customer_name = $data['customers_name'];
            $customers ->customer_phone = $data['customers_phone'];
            $customers ->customer_token = $code ;

            $to_name = $customers ->customer_name;
            $to_email = $customers ->customer_email;
            $customers -> save();

            $link_verify = url('/verify?id='.$customers->customer_id.'&token='.$code);
            $data_send = array("name"=>$to_name,"body"=>$link_verify );

            Mail::send('customer.active',$data_send,function($message) use ($to_name,$to_email)
            {
                $message->to($to_email)->subject('Kích hoạt tài khoản shopforpet.xyz');
                $message->from($to_email,$to_name);

            });
            Session::put('message','Đăng ký thành công !!!');
            return Redirect::to('register');

        }
        else{

            Session::put('message','Email đã có người đăng ký!!!');
            return Redirect::to('register');

        }
        // Customers::create([
        //     'customers_email' =>  $data['customers_email'],
        //     'customers_password' => $data['customers_password'],
        //     'customers_name' => $data['customers_name'],
        //     'customers_phone' => $data['customers_phone']
        // ]);
    }

    public function logout(Request $request){

        Session::put('customer_name', null);
        Session::put('customer_id',null);
        return Redirect::to('/');
    }



}
