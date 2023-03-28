<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use DataTables;

class ProductsController extends Controller
{
    //
    protected $productmodel;

    public function __construct(Product $product) {
        $this->productmodel = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index');
    }

    public function getProductsDatatable()
    {
        $data = Product::select('*')->with('category');
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                //

                // if (auth()->user()->can('viewAny', $this->setting)) {
                    return $btn = '
                        <a href="' . Route('dashboard.product.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                        <a href="' . Route('dashboard.booking.add', $row->id) . '"  class="edit btn btn-info btn-sm" ><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                // }
            })

            ->addColumn('parent', function ($row) {
                return ($row->parent ==  0) ? trans('word.main category') :   $row->parents->translate(app()->getLocale())->title;
            })


            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->addColumn('status', function ($row) {
                return $row->status == null ? __('word.not activated') : __('word.' . $row->status);
            })
            ->rawColumns(['action', 'status', 'title'])
            ->make(true);
    }

    public function create()
    {
        $categories = Category::all();
        if (count($categories)>0) {
            return view('dashboard.products.add' , compact('categories'));
        }
        abort(404);
    }


    public function store(Request $request)
    {
        // $this->authorize('create' , $this->postmodel);
        $data = [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required',
        ];

        
        foreach (config('app.languages') as $key => $value) {
            $data[$key . '*.title'] = 'required|string|min:3|max:200';
            $data[$key . '*.smallDesc'] = 'required|string|min:3|max:500';
            $data[$key . '*.content'] = 'required|string|min:3|max:3000';
            $data[$key . '*.price'] = 'required|string';
        }
        $validatedData = $request->validate($data);

        $product = Product::create($request->except('image','_token'));

        // $product->update(['user_id' => auth()->user()->id]);
      
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
            $product->update(['image' => $path]);
        }
        
        return redirect()->route('dashboard.product.index');
    }


    public function edit(Product $product)
    {
       // $this->authorize('update' , $post);
        $categories = Category::all();
        return view('dashboard.products.edit' , compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required',
        ];

        
        foreach (config('app.languages') as $key => $value) {
            $data[$key . '*.title'] = 'required|string|min:3|max:200';
            $data[$key . '*.smallDesc'] = 'required|string|min:3|max:500';
            $data[$key . '*.content'] = 'required|string|min:3|max:3000';
            $data[$key . '*.price'] = 'required|string';
        }
        $validatedData = $request->validate($data);

       // $this->authorize('update' , $post);
        $product->update($request->except('image','_token'));
       // $product->update(['user_id' => auth()->user()->id]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
            $product->update(['image' => $path]);
        }
        
        return redirect()->route('dashboard.product.edit' , $product);
    }

    public function delete (Request $request)
    {

       // $this->authorize('delete' , $this->postmodel->find($request->id));
        if(is_numeric($request->id)){
            Product::where('id' , $request->id)->delete();
        }
        return redirect()->route('dashboard.product.index');
    }
}
