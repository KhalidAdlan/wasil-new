<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\ProductTag;
use App\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->active()->get();
        $top_products = Product::active()->paginate(9);

        return view('home.index', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }

    public function terms()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->active()->get();
        $top_products = Product::active()->paginate(9);

        return view('home.terms', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }

    public function about()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->active()->get();
        $top_products = Product::active()->paginate(9);

        return view('home.about', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function services()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->active()->get();
        $top_products = Product::active()->paginate(9);

        return view('home.services', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }


    public function showProduct($pid)
    {
      $product = Product::find($pid);

       return view('home.product', ['categories'=> ProductCategory::all(),'product' => $product]);

    }

    public function category($cid)
    {
        $category = ProductCategory::findOrFail($cid);
        $top_products = $category->categoryProducts()->active()->paginate(9);
       
        $message = $category->name;

        return view('home.category', ['message' => $message,'categories'=> ProductCategory::all(),'top_products' => $top_products]);
    }


    public function removeCartItem(Request $request)
    {
       $id = $request->pid;
       $cart = session()->get('cart');
       $cartItem =  $cart[$id];

       unset($cart[$id]);

       session()->put('cart',$cart);
       
       return response()->json(['success' => 'Item successfully removed',  'item' => $cartItem]);

    }

    public function updateCart(Request $request)
    {
        $id = $request->pid;
        $newQty = $request->qty;
        $cart = session()->get('cart');
        $cartItem =  $cart[$id];
        $cartItem['quantity'] = $newQty;
    
        $cart[$id] = $cartItem;
        session()->put('cart', $cart);


        return response()->json(['success'=>'Data is successfully added', 'item' => $cartItem]);
    }

    public function getCustomerInfo()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->active()->get();
        $top_products = Product::active()->paginate(9);

        return view('home.customer-info', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    
    }

   
    public function storeCustomer(Request $request)
    {

        $name = $request->name;
        $phone = $request->phone;
        $phone2 = $request->phone2;
        $state = $request->radio;
        $area = $request->select;
        $address = $request->address;

        if(!isset($name))
        return redirect()->back()->with('error', '');

        if(!isset($phone))
        return redirect()->back()->with('error', '');

        if(!isset($area))
        return redirect()->back()->with('error', '');

        if(!isset($address))
        return redirect()->back()->with('error', '');

        $stateText = '';

        switch($state)
        {
            case 'bhri':
            $stateText = 'بحري';
            break;

            case 'khrt':
            $stateText = 'الخرطوم';
            break;

            case 'omdur':
            $stateText = 'امدرمان';
            break;

            case 'other':
            $stateText = 'الولايات';
            break;
        }

        $customer = [
            "name"    => $name,
            "phone"   => $phone,
            "phone2"  => $phone2,
            "state"   => $stateText,
            "area"    => $area,
            "address" => $address
        ];

        $total = 0;

        foreach(session()->get('cart') as $item)
        {
            $total += $item['quantity'] * $item['price'];
        }

        $delivery = 200;

        if($state=="other")
        {
            $delivery = 300;

            if($total >= 6000)
             $delivery = 600;

            if($total >= 12000)
             $delivery = 900;

            if($total >= 18000)
             $delivery = 1200; 
        }

        $grandTotal = $total + $delivery;

        $totals = [
            "total"      => $total,
            "delivery"   => $delivery,
            "grandTotal" => $grandTotal
        ];

        session()->put('customer', $customer);

        $hot_products = ProductTag::all()->first()->tagProducts()->active()->get();

        return view('home.invoice', ['totals' =>$totals, 'categories'=> ProductCategory::all(), 'hot_products' => $hot_products]);
    

        
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
       $top_products = Product::query()
        ->where('name', 'LIKE', "%{$keyword}%") 
        ->orWhere('description', 'LIKE', "%{$keyword}%") 
        ->active()->paginate(9);

        $message = null;
        $error = null;

        if(count($top_products) > 0)
        {
            $message = "وجدنا ". count($top_products) . "نتيجة عن '" .$keyword ."'";
        }
        else{
            $error = "لا توجد نتائج للبحث";

        }





        return view('home.category', ['error'=> $error,'message' => $message,'categories'=> ProductCategory::all(),'top_products' => $top_products]);

    }



    public function addToCart($id)
    {
        $product = Product::find($id);
 
        if(!$product) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "id"       => $id,
                        "name"     => $product->name,
                        "quantity" => 1,
                        "price"    => $product->price,
                        "photo"    => $product->getPhotoAttribute()[0]->thumbnail
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', '!لقد تمت الاضافة لسلة مشترياتك بنجاح');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', '!لقد تمت الاضافة لسلة مشترياتك بنجاح');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id"       => $id,
            "name"     => $product->name,
            "quantity" => 1,
            "price"    => $product->price,
            "photo"    => $product->getPhotoAttribute()[0]->thumbnail
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', '!لقد تمت الاضافة لسلة مشترياتك بنجاح');
    }


}
