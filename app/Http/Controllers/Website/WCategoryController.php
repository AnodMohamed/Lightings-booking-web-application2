<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WCategoryController extends Controller
{
    //
    
    public function show(Category $category)
    {
        $category = $category->load('children');
        $products = Product::where('category_id' , $category->id)->paginate(15);
        
        return view('website.category' , compact('category','products'));
    }
}
