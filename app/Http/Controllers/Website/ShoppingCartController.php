<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Cart;
use Exception;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    //


    public function cart(){
        return view('website.shoppingcart');
    }

    public function store(Booking $booking){

        $product = ProductTranslation::find($booking->id);
        Cart::add($booking->id,$product->title,1,$product->price)->associate('\App\Models\ProductTranslation');
        return redirect()->back();

    }

    public function checkout(){
        return view('website.checkout');
    }

    public function checkoutstore(Request $request){
        
        $data = [    
            'mobile' =>'required|numeric|digits:10',
            'email' => 'required|email',
            'zipcode' => 'required|numeric',
            'support' => 'required|numeric',

        ];

        
        foreach (config('app.languages') as $key => $value) {
            $data[$key . '*.firstname'] = 'required|string|min:3|max:200';
            $data[$key . '*.lastname'] = 'required|string|min:3|max:200';
            $data[$key . '*.address'] = 'required|string|min:3|max:255';
        }

        $validatedData = $request->validate($data);


        $finalltotal =  Cart::total();


        $order = Order::create(
            $request->except('subtotal','total', 'finalltotal', '_token')
        );

        $order->subtotal =Cart::subtotal();
        $order->total = Cart::total();
        $order->finalltotal = $finalltotal;
        $order->save();

        foreach(Cart::content() as $item)
        {
            $orderitem = new OrderItem();
            $orderitem->booking_id =$item->id;
            $orderitem->order_id =$order->id;
            $orderitem->save();

            $booking =Booking::find($item->id);
            $booking->status = 1;
            $booking->user_id = Auth::user()->id;
            $booking->update();
        }

         //add STRIPE_SECRET 
         $stripe = new  \Stripe\StripeClient(env('STRIPE_SECRET'));
              
         $customer = $stripe->customers->create([
             'source' => 'tok_mastercard',
             "email" => $request->email,
         ]);

            //add card detials
        $stripe->tokens->create([
    
            'card' => [
            'name'=> Auth::user()->name,
            'number' =>$request->card_no,
            'exp_month' =>$request->exp_month,
            'exp_year' =>$request->exp_year,
            'cvc' => $request->cvc,
            ],

        ]);      
        
        $usd = 3.27 * $finalltotal;
        $int_price=(int)$usd ;


        //send data to stripe
        $intent =  $stripe->paymentIntents->create([
            'amount'=> $int_price."00",
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'payment_method' => 'pm_card_visa',
            'customer'=> $customer,
            'confirm' => true,
        ]);       

        // check if status is success
        $paymentStatus = json_decode($this->generateResponse($intent),true);
    
        if ($paymentStatus['success'] === true) {
               
            if ($customer) {

                //add Transaction detials to database
                $transaction = new Transaction();
                $transaction->customer_id =Auth::user()->id;
                $transaction->order_id =$order->id;
                $transaction->amount = $int_price ;
                $transaction->status ='Payed';
                $transaction->transaction_id = $customer->id;
                $transaction->save();
                
    
            }
             
            Cart::destroy();  
            
            
        }   
        return redirect()->route('website.orders.index');

    }


    public function generateResponse($intent) {
        if ($intent->status == 'succeeded') {
          // Handle post-payment fulfillment
          return json_encode(['success' => true]);
        } else {
          // Any other status would be unexpected, so error
          return json_encode(['error' => 'Invalid PaymentIntent status']);
        }
    }

    public function delete($id){


        Cart::remove($id);
        // set a error message in the session
        session()->flash('success', __('word.success delete'));

        return redirect()->back();


    }
}
