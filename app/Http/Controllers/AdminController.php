<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Admin;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
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
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){

        $data = $request->all();
        $admin= Admin::where('admin_email',$data['admin_email'])->first();
       if(md5($data['admin_password'])==$admin->admin_password)
       {
        Session::put('admin_name', $admin->admin_name);
        Session::put('admin_id',$admin->admin_id);
        return Redirect::to('dashboard');
       }else{
            Session::put('message','Mật khẩu hoặc tài khoản sai!!!');
            return Redirect::to('admin');
        }

    }

   public function logout(Request $request){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id',null);
        return Redirect::to('admin');
    }
}
