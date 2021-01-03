<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
class CustomersController extends Controller
{
    public function index_login ()
    {
        return view('login');
    }
    public function index_register ()
    {
        return view('register');
    }

//     public function findByEmail($email)
//    {
//        $customers = customers::where('customers_email',$email)->first();
//        return $customers;
//    }

    public function save_register_list(Request $request)
    {
        $data = $request->all();

        $customers = new Customers();
        $customers = Customers::where('customers_email',$data['customers_email'])->first();
        if($customers==null)
        {
            $customers =new Customers();
            $customers ->customers_email = $data['customers_email'];
            $customers ->customers_password = md5($data['customers_password']);
            $customers ->customers_name = $data['customers_name'];
            $customers ->customers_phone = $data['customers_phone'];
            $customers -> save();
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

   


}
