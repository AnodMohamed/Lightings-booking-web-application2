<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WProudctController extends Controller
{
    //
    public function show(Product $product)
    {
        return view('website.product' , compact('product'));
    }
}
