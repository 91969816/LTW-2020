<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Models\CategoryProducts;
use App\Models\BrandProducts;
use App\Models\Products;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{

    public function index()
    {
        $cate_product = CategoryProducts::orderby('category_id','desc')->get();

        $brand_product = BrandProducts::orderby('brand_id','desc')->get();

        //$all_product = DB::table('tbl_product')
        //->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        //->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        //->orderby('tbl_product.product_id','desc')->get();

        $all_product = Products::where('product_status','0')->orderby('product_id','desc')->limit(12)->get();

        return view('welcome')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
}
