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
        $hot_products = ProductTag::all()->first()->tagProducts()->get();
        $top_products = Product::paginate(9);

        return view('home.index', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }

    public function terms()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->get();
        $top_products = Product::paginate(9);

        return view('home.terms', ['categories'=> ProductCategory::all(), 'hot_products' => $hot_products, 'top_products' => $top_products]);
    }

    public function about()
    {
        $hot_products = ProductTag::all()->first()->tagProducts()->get();
        $top_products = Product::paginate(9);

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
        $hot_products = ProductTag::all()->first()->tagProducts()->get();
        $top_products = Product::paginate(9);

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
        //$products_collection = $category->categoryProducts()->get();
        $top_products = $category->categoryProducts()->paginate(9);
       
      
        return view('home.category', ['categories'=> ProductCategory::all(),'top_products' => $top_products]);
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
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "photo" => $product->photo
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
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->getPhotoAttribute()[0]->thumbnail
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


}
