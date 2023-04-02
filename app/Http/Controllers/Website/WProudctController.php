<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;

class WProudctController extends Controller
{
    //
    public function show(Product $product)
    {
        $bookings = Booking::where('product_id',$product->id)->where('date', '>', now())->get();
        
        return view('website.product' , compact('product','bookings'));
    }
}
