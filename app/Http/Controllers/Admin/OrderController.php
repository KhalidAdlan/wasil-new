<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Order;
use App\Product;
use App\Salesman;
use App\Line;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Order::with(['customer', 'product', 'salesmen'])->select(sprintf('%s.*', (new Order)->table));
            $table = Datatables::of($query);


            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_show';
                $editGate      = 'order_edit';
                $deleteGate    = 'order_delete';
                $crudRoutePart = 'orders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('invoice_number', function ($row) {
                return $row->invoice_number ? $row->invoice_number : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->addColumn('customer_name', function ($row) {
                return $row->customer ? $row->customer->name : '';
            });

            $table->editColumn('customer.phone', function ($row) {
                return $row->customer ? (is_string($row->customer) ? $row->customer : $row->customer->phone) : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('product.price', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->price) : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });

            $table->addColumn('salesmen_name', function ($row) {

                return $row->salesmen ? json_encode($row->salesmen,JSON_UNESCAPED_UNICODE): '';
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? \Carbon\Carbon::createFromTimeStamp(strtotime($row->created_at))->diffForHumans() : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'customer', 'product', 'salesmen']);

            return $table->make(true);
        }

        $availableLines = Line::availableLines();

        $waitingLinesCount = DB::table('orders')->where('status','انتظار')->distinct('line_id')->count();
        $waitingProductsCount = DB::table('orders')->where('status','انتظار')->distinct('product_id')->count();
        $waitingLinesIds = DB::table('orders')->where('status', 'انتظار')->distinct()->get(['line_id']);
        $waitingLines = [];

        foreach( $waitingLinesIds as $waitingLineId)
        {
            $waitingLine = Line::find($waitingLineId->line_id);
            if(isset($waitingLine))
            array_push($waitingLines, $waitingLine);
        }
        return view('admin.orders.index', [
            'lines' => $availableLines,
            'waiting_lines_count' => $waitingLinesCount,
            'waiting_products_count' => $waitingProductsCount,
            'waiting_lines' => $waitingLines
        ]);
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salesmens = Salesman::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('customers', 'products', 'salesmens'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salesmens = Salesman::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('customer', 'product', 'salesmen');

        return view('admin.orders.edit', compact('customers', 'products', 'salesmens', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('customer', 'product', 'salesmen');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function pickup(Request $request)
    {
        $line = Line::find($request->all()['line']);
        
        Order::pickup($request->all()['invoice_number'], $line->id);

        return back();    
    }

    public function changeState(Request $request)
    {
        if(isset($request->all()['line']) && !isset($request->all()['invoice_number']))
        {
            $line = Line::find($request->all()['line']);
            $state = $request->all()['state'];
    
            $orders = Order::all()->where('status','!=', $state)->where('line_id',$line->id);
    
            foreach($orders as $order)
            {
                Order::changeState($order->id, $state);
    
            }
         
          if($state == "تم الشحن")
          {
            Line::updateAvailability($line->id);
          }
    
    
    
        }

        if(isset($request->all()['invoice_number']))
        {
            $line = Line::find($request->all()['line']);
            
            $invoice_number = $request->all()['invoice_number'];

            $state = $request->all()['state'];
    
            $orders = Order::all()->where('status','!=', $state)->where('line_id',$line->id)->where('invoice_number',$invoice_number);
    
            foreach($orders as $order)
            {
                Order::changeState($order->id, $state);
    
            }

            Line::updateAvailability($line->id);
         
        }
        
        return back();

        
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    
    
}
