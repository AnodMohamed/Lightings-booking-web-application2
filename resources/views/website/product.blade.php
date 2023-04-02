@extends('layouts.website')
@section('meta_description')
        {{ strip_tags($product->content)}}
@endsection
@section('meta_keywords')
        الكلمات الدلالية
@endsection

@section('title')
{{$product->title}} - {{$setting->title}}
@endsection


@section('body')
 <!-- Breadcrumb Start -->
 <div class="container-fluid  pt-3" 
    @if ($setting->translate(app()->getlocale())->title == 'العربية') 
        style="direction: rtl;"
    @endif
  >
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="{{route('index')}}"> {{ __('word.home') }}</a>
            <a class="breadcrumb-item" href="#">{{$product->category->title}}</a>
            <span class="breadcrumb-item active">{{$product->title}}</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                   
                    <img class="img-fluid w-100" src="{{asset($product->image)}}" style="object-fit: cover;">
                    <div class="overlay position-relative bg-light">
               
                        <div class="mb-3">
                            <a href="">{{$product->category->title}}</a>
                            <span class="px-1">/</span>
                            <span>{{$product->created_at->format('M d,Y')}}</span>
                        </div>
                        <div>
                            <h3 class="mb-3">{{$product->title}}</h3>
                            <p>{!! $product->smallDesc !!}</p>
                            <p>{!! $product->content !!}</p>


                            @if(count($bookings) > 0)
                                @foreach ($bookings as $booking)
                                    @php
                                        $bookingId = $booking->id;
                                        $cartHasBookingId = false;

                                        Cart::content()->each(function ($cartItem) use ($bookingId, &$cartHasBookingId) {
                                            if ($cartItem->id === $bookingId) {
                                                $cartHasBookingId = true;
                                                return false; // stop the loop early since the booking ID has been found
                                            }
                                        });                                   
                                        
                                    @endphp
                                
                                    
                                    @if (!$cartHasBookingId) 
                                        <a href="{{Route('product.cart',$booking->id)}}" class="btn btn-sm btn-outline-secondary m-1">{{ $booking->date }}</a>
                                    @endif 
                
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->

@endsection
