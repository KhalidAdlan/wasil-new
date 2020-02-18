<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\ProductTag;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Customer;
use App\Order;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class SalesPersonsController extends Controller
{
    public function getLoginForm()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->get();
        $top_products = Product::paginate(9);

        return view('home.login', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }

    public function attemptLogin(Request $request)
    {
         $username = $request->username;
         $password = $request->password;
         if(!isset($username))
         {
             $errorMessage = "";
             return redirect()->back()->with(['error' => $errorMessage]);
         }

         if(!isset($password))
         {
             $errorMessage = "";
             return redirect()->back()->with(['error' => $errorMessage]);
         }


         $isVerified = DB::table('salesmen')->where('username', $username)->where('password', $password)->exists();

         if($isVerified)
         {
           $user = DB::table('salesmen')->where('username', $username)->where('password', $password)->first();
           session()->put('isSalesmanLoggedIn', true);
           session()->put('salesman', $user);

           return redirect('/portal');
         }
         else
         {
            $errorMessage = "";
            return redirect()->back()->with(['error' => $errorMessage]);
         }
    }

    public function logout()
    {
        session()->remove('salesman');
        return redirect('/');
    }

    public function getSalesmanPortal(Request $request)
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->get();
        $top_products = Product::paginate(9);
       // $query = Order::with(['customer', 'product', 'salesmen'])->select(->where('salesmen.id','=',session()->get('salesman')->id);

        $orders = Order::with(['customer', 'product'])->where('salesmen_id','=',session()->get('salesman')->id)->orderBy('invoice_number','desc')->get()->groupBy('invoice_number');

        

        

        return view('home.portal', ['orders'=> $orders,'categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
 
    }
}
