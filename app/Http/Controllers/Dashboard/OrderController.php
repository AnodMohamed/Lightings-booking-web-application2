<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTranslation;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function index(){
        $orders = Order::all();
        return view('dashboard.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);

        $orderwithlang = OrderTranslation::where('order_id',$id)->get();

        $orderitem = OrderItem::where('order_id',$id)->get();

        $transaction = Transaction::where('order_id',$id)->first();

        return view('dashboard.orders.orderitems',compact('order','orderwithlang','orderitem','transaction'));
    }

    public function delivered($id)
    {

        $orderwithlang = OrderTranslation::where('order_id',$id)->get();

        foreach ($orderwithlang as $orderlang){
            $orderlang->status = 2;

            $orderlang->save();

        }

        return redirect()->back();    
    
    }

    public function returned($id){

        $orderwithlang = OrderTranslation::where('order_id',$id)->get();

        foreach ($orderwithlang as $orderlang){
            $orderlang->status = 3;

            $orderlang->save();

        }

        return redirect()->back();    

    }
}
