<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTranslation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class WOrederController extends Controller
{
    //
    
    //
    protected $ordermodel;

    public function __construct(Order $order) {
        $this->ordermodel = $order;
    }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myorders = Order::where('user_id',Auth::user()->id)->get();
        return view('website.orders',compact('myorders'));
    }

    public function show($id)
    {
        $order = Order::find($id);

        $orderwithlang = OrderTranslation::where('order_id',$id)->get();

        $orderitem = OrderItem::where('order_id',$id)->get();

        $transaction = Transaction::where('order_id',$id)->first();

        return view('website.orderitems',compact('order','orderwithlang','orderitem','transaction'));
    }
    // geOrdersDatatable

    public function geOrdersDatatable()
    {
        $data = Order::select('*')->with('category');
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                //

                // if (auth()->user()->can('viewAny', $this->setting)) {
                    // return $btn = '
                    //     <a href="' . Route('dashboard.product.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                    //     <a href="' . Route('dashboard.booking.add', $row->id) . '"  class="edit btn btn-info btn-sm" ><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>
                    //     <a href="' . Route('dashboard.booking.dashboard', $row->id) . '"  class="edit btn btn-primary btn-sm"> <i class="fa fa-calendar" aria-hidden="true"></i></a>
                    //     <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>

                    //     ';

                // }
            })

            ->make(true);
    }
}
