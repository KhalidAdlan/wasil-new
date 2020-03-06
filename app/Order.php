<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'status',
        'product_id',
        'quantity',
        'line_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'customer_id',
        'salesmen_id',
        'invoice_number',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public static function generateValidInvoiceNumber()
    {
       $lastOrder = DB::table('orders')->orderBy('id', 'desc')->first();
       if(!isset($lastOrder))
         return 1;

       $invoiceNumber = $lastOrder->invoice_number + 1;
       return $invoiceNumber;
    }

    public function total()
    {
        $orders = DB::table('orders')->where('deleted_at',null)->where('invoice_number', $this->invoice_number)->get();

        $total = 0;
        foreach($orders as $order)
        {
            try{
            $product = Product::find($order->product_id);

           $total += ($product->price * $order->quantity);
            }
            catch(\Exception $e)
            {

            }
        }

        return $total;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function pickup($invoiceNumber,$lineId)
    {
        Order::where('invoice_number', '=', $invoiceNumber)
        ->update(['line_id' => $lineId, 'status' => 'انتظار']);
    }

    public static function changeState($order_id,$state)
    {
        Order::where('id', '=', $order_id)
        ->update(['status' => $state]);
    }

    public function salesmen()
    {
        return $this->belongsTo(Salesman::class, 'salesmen_id');
    }
}
