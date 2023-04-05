@extends('layouts.website')

@section('body')
    <!-- Breadcrumb Start -->
    <div class="container-fluid pt-3" 
        @if ($setting->translate(app()->getlocale())->title == 'العربية') 
            style="direction: rtl;"
        @endif
    >
        <div class="container" >
            <nav class="breadcrumb bg-transparent m-0 p-0" >
                <a class="breadcrumb-item" href="{{route('index')}}"> {{ __('word.home') }}</a>
                <a class="breadcrumb-item"  href="{{route('website.orders.index')}}"> {{ __('word.My orders') }}</a>

                <span class="breadcrumb-item active">{{ __('word.order details') }}</span>
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
                    <div class=" mb-3">
                        <div class="py-3 bg-light row" 
                        @if ($setting->translate(app()->getlocale())->title == 'العربية') 
                            style="direction: rtl;"
                        @endif
                        >
                                <div class="col-4">
                                    <div class="d-flex justify-content-between information"><span>ID</span><span>{{ $order->id}}</span></div>
                                    <div class="d-flex justify-content-between information"><span>{{__('word.total')}}</span><span>{{ $order->total}}</span></div>
                                    <div class="d-flex justify-content-between information"><span>{{__('word.mobile')}}</span><span>{{ $order->mobile}}</span></div>
                                    <div class="d-flex justify-content-between information"><span>{{__('word.email')}}</span><span>{{ $order->email}}</span></div>
                                    <div class="d-flex justify-content-between information"><span>{{__('word.zipcode')}}</span><span>{{ $order->zipcode}}</span></div>
                                    <div class="d-flex justify-content-between information"><span>{{__('word.support table')}}</span>
                                        <span>
                                            @if ( $order->support == 0)
                                                {{__('word.no')}} 
                                            @else
                                                {{__('word.yes')}} 
                                            @endif
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between information"><span>{{__('word.transaction_id')}}</span><span>{{ $transaction->transaction_id}}</span></div>

                                    @foreach ($orderwithlang as $orderlang)
                                        @if ($orderlang->locale == 'en')
                                            <div class="d-flex justify-content-between information"><span>{{__('word.firstname')}}</span><span>{{ $orderlang->firstname}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.lastname')}}</span><span>{{ $orderlang->lastname}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.address')}}</span><span>{{ $orderlang->address}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.status')}}</span>
                                                <span>
                                                    @if ( $orderlang->status == 1)
                                                        {{__('word.Delivery is in progress')}} 
                                                    @elseif ( $orderlang->status == 2)
                                                        {{__('word.Delivery is in progress')}} 
                                                    @elseif ( $orderlang->status == 3)
                                                        {{__('word.Returned')}} 
                                                    @endif
                                                </span>
                                            </div>
                                        @elseif($orderlang->locale == 'ar')
                                            <div class="d-flex justify-content-between information"><span>{{__('word.firstname')}}</span><span>{{ $orderlang->firstname}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.lastname')}}</span><span>{{ $orderlang->lastname}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.address')}}</span><span>{{ $orderlang->address}}</span></div>
                                            <div class="d-flex justify-content-between information"><span>{{__('word.status')}}</span>
                                                <span>
                                                    @if ( $orderlang->status == 1)
                                                        {{__('word.Delivery is in progress')}} 
                                                    @elseif ( $orderlang->status == 2)
                                                        {{__('word.Delivery is in progress')}} 
                                                    @elseif ( $orderlang->status == 3)
                                                        {{__('word.Returned')}} 
                                                    @endif
                                                </span>
                                            </div>

                                        @endif
                                        
                                    @endforeach
                                </div>
                                <div class="col-8">

                                         @foreach ($orderitem as $item)
                                            @php
                                                    $booking=DB::table('bookings')->where('id',$item->booking_id)->first();
        
                                                    $product=DB::table('product_translations')->where('product_id',$booking->product_id)->where('locale',$setting->translate(app()->getlocale())->locale)->first();
        
                                                    $productmain=DB::table('products')->where('id',$booking->product_id)->first();
                                            @endphp
        
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
                                                          
                                                        </div>
                                                    </div>
                                           
        
        
                                            
                                         @endforeach 

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

@endsection