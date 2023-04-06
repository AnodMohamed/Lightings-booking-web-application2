<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;
use \Illuminate\Support\Str;

class SettingController extends Controller
{
    //
    public function index()
    {
        //$setting = Setting::all();
       // $this->authorize('view', $setting);
        return view('dashboard.settings');
    }

    public function update(Request $request , Setting $setting)
    {
        $data = [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email',

        ];

        foreach (config('app.languages') as $key => $value) {
            $data[$key . '*.title'] = 'nullable|string';
            $data[$key . '*.content'] = 'nullable|string';
            $data[$key . '*.address'] = 'nullable|string';
        }
        $validatedData = $request->validate($data);

        $setting->update($request->except('image', 'favicon', '_token'));
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
            $setting->update(['logo' => $path]);
        }
        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = '/images/' . $filename;
            $setting->update(['favicon' => $path]);
        }
        return redirect()->route('dashboard.settings');

    
        
    }

    public function dashboard(){
        $countproducts = Product::count();
        $countorders = Order::count();
        $countbookings = Booking::where('date', '>', now())
                                ->where('status', '==', 0)
                                ->count();
        $counttransactions = Transaction::sum('amount');

        $last6orders = Order::latest('created_at')
                            ->take(6)
                            ->get();

        $last6prducts = Product::latest('created_at')
                            ->take(6)
                            ->get();

        return view('dashboard.index' , compact('countproducts','countorders',
        'countbookings','counttransactions','last6orders','last6prducts'));

    }

}
