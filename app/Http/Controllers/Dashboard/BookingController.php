<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    //
    public function dashboard($booking)
    {
        $bookings = Booking::where('product_id',$booking)->get();
        return view('dashboard.bookings.index', compact('bookings'));

    }

    public function add($booking)
    {
        return view('dashboard.bookings.add', compact('booking'));

    }

    public function store(Request $request)
    {
        $data = [
            'date' => 'required|date|date_format:Y-m-d|before:today',
        ];

        $request->validate($data);

        if (Booking::where('date', $request->date)->where('product_id', $request->product_id)->exists()) {
            // Date exists in booking table with same value in product_id column

            // set a error message in the session
            $request->session()->flash('error', __('word.exists date'));

            return redirect()->back();

        } else {
            // Date does not exist in booking table with same value in product_id column
            $booking = new Booking;
            $booking->date = $request->date;
            $booking->product_id = $request->product_id;
            $booking->save();

            // set a success message in the session
            $request->session()->flash('success', __('word.success add'));

            return redirect()->route('dashboard.product.index');
        }
    }

    public function delete (Request $request)
    {

       // $this->authorize('delete' , $this->postmodel->find($request->id));
        if(is_numeric($request->id)){
            Booking::where('id' , $request->id)->delete();
            // set a success message in the session
            $request->session()->flash('success', __('word.success delete'));

        }

        return redirect()->back();
    }
}
