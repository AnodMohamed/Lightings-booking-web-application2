@extends('layouts.website')






@section('body')
 <!-- Breadcrumb Start -->
 <div class="container-fluid  pt-3
 
    ">
    <div class="container" 
        @if ($setting->translate(app()->getlocale())->title == 'العربية') 
            style="direction: rtl;"
        @endif
    >
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="{{route('index')}}"> {{ __('word.home') }}</a>
            <span class="breadcrumb-item active"> {{__('word.shopping cart')}}</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-white" 
                @if ($setting->translate(app()->getlocale())->title == 'العربية') 
                    style="direction: rtl;"
                @endif
            >
                <div class="container mt-5 p-3 rounded cart">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            @if (session('success'))
                                <div id="successMessage" class="alert alert-success"  style="display: none;">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="product-details mr-2">
                                <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span class="ml-2">                        
                                    <h6 class="mb-0">{{__('word.shopping cart')}}</h6>
                                    <p class="d-flex justify-content-between"><span>{{__('word.count cart item')}} {{ Cart::count() }}</span></p></span></div>
                                <hr>
                                @if (Cart::count() > 0)
                                    @foreach (Cart::content() as $item)
                                        @php
                                            $booking=DB::table('bookings')->where('id',$item->id)->first();

                                            $product=DB::table('product_translations')->where('product_id',$booking->product_id)->where('locale',$setting->translate(app()->getlocale())->locale)->first();

                                            $productmain=DB::table('products')->where('id',$booking->product_id)->first();
                                        @endphp

                                        @if ($booking->status == 0)
                                            <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                                                <div class="d-flex flex-row">
                                                    <img class="rounded" src="{{asset($productmain->image)}}"  width="40">
                                                    <div class="ml-2">
                                                        <a href="{{Route('product',$productmain->id)}}">
                                                            <span class="font-weight-bold d-block">{{$product->title}}</span>
                                                        </a>
                                                        <span class="spec">{!! $product->smallDesc !!}</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row align-items-center"><span class="d-block">{{$booking->date}}</span>
                                                    <span class="d-block ml-5 font-weight-bold">{{$product->price}}</span>
                                                    <a href="{{Route('product.cart.delete',$item->rowId)}}"
                                                       class="d-block ml-5 font-weight-bold"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                </div>
                                            </div>
                                        @else
                                            @php
                                                Cart::remove($item->rowId);
                                            @endphp
                                        @endif


                                    
                                    @endforeach 
                                @endif
                                    
                                
                               

                            </div>
                        </div>
                        @if (Cart::count() > 0)
                            <div class="col-md-4">
                                <div class="payment-info">

                                    @if (Auth::check())
                                        @if (Auth::user()->status === 'customer')
                                            <div class="d-flex justify-content-between information"><span>{{__('word.subtotal')}}</span><span>{{Cart::subtotal()}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.total')}}</span><span>{{Cart::total()}}</span></div>
                                                <a href="{{ route('website.product.cart.checkout') }}" class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button">
                                                    <span>{{Cart::total()}}</span><span>{{__('word.checkout')}}<i class="fa fa-long-arrow-right ml-1"></i></span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-between information"><span>{{__('word.not allowed')}}</span></div>
                                            
                                            </div>
                                        @endif

                                    @else
                                        <div class="d-flex justify-content-between information"><span>{{__('word.subtotal')}}</span><span>{{Cart::subtotal()}}</span></div>
                                        <div class="d-flex justify-content-between information"><span>{{__('word.total')}}</span><span>{{Cart::total()}}</span></div>
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button">
                                                <span>{{Cart::total()}}</span><span>{{__('word.login')}}<i class="fa fa-long-arrow-right ml-1"></i></span>
                                            </a>
                                        </div>
                                    @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->

@endsection

@push('javascripts')

    <script>
        $(document).ready(function() {
            // show the success message
            $('#successMessage').show();

            // hide the success message after 3 seconds
            setTimeout(function() {
                $('#successMessage').fadeOut('fast');
            }, 3000);
        });
    </script>

@endpush
