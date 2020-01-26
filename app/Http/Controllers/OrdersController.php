<?php
 namespace App\Http\Controllers;

use App\ProductCategory;
use App\ProductTag;
use App\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Customer;
use App\Order;


class OrdersController extends Controller
{
    public function placeOrder(){

        $cart = session()->get('cart');
        $customerInfo = session()->get('customer');

        if(!isset($cart) || !isset($customerInfo ))
           return redirect()->back();  //change this

        $customer = Customer::create($customerInfo);
        $invoiceNumber = Order::generateValidInvoiceNumber();

        foreach($cart as $item)
        {
            $orderEntry = [
                'customer_id' => $customer->id,
                'status'    => 'جديد',
                'invoice_number' => $invoiceNumber,
                'product_id'    => $item['id']
            ];

           Order::create($orderEntry);
        }

        session()->forget('cart');


         $hot_products = ProductTag::all()->first()->tagProducts()->get();
         $top_products = Product::paginate(9);
         $message = "لقد تم تأكيد طلبك! شكرا لاستخدامك واصل!";


        return view('home.index', ['categories'=> ProductCategory::all(),'message' => $message, 'hot_products' => $hot_products, 'top_products' => $top_products]);
    
       
        redirect('/');
    }
}
