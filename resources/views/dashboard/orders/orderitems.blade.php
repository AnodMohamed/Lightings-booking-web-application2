@extends('layouts.dashboard')

@section('body')

<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a  href="{{route('dashboard.index')}}"> {{__('word.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ __('word.orders') }}</li>
    </ol>


    {{-- {{dd($setting)}} --}}

    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ __('word.orders') }}
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="col-4">
                                <div class="d-flex justify-content-between information"><span >ID: </span><span>{{ $order->id}}</span></div>
                                <div class="d-flex justify-content-between information"><span>{{__('word.total')}}:</span><span>{{ $order->total}}</span></div>
                                <div class="d-flex justify-content-between information"><span>{{__('word.mobile')}}:</span><span>{{ $order->mobile}}</span></div>
                                <div class="d-flex justify-content-between information"><span>{{__('word.email')}}:</span><span>{{ $order->email}}</span></div>
                                <div class="d-flex justify-content-between information"><span>{{__('word.zipcode')}}:</span><span>{{ $order->zipcode}}</span></div>
                                <div class="d-flex justify-content-between information"><span>{{__('word.support table')}}:</span>
                                    <span>
                                        @if ( $order->support == 0)
                                            {{__('word.no')}} 
                                        @else
                                            {{__('word.yes')}} 
                                        @endif
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between information"><span>{{__('word.transaction_id')}}:</span><span>{{ $transaction->transaction_id}}</span></div>

                                @foreach ($orderwithlang as $orderlang)
                                    @if ($orderlang->locale == $setting->translate(app()->getlocale())->locale)
                                        <div class="d-flex justify-content-between information mx-2"><span>{{__('word.firstname')}}:</span><span>{{ $orderlang->firstname}}</span></div>
                                        <div class="d-flex justify-content-between information"><span>{{__('word.lastname')}}:</span><span>{{ $orderlang->lastname}}</span></div>
                                        <div class="d-flex justify-content-between information"><span>{{__('word.address')}}:</span><span>{{ $orderlang->address}}</span></div>
                                        <div class="d-flex justify-content-between information"><span>{{__('word.status')}}:</span>
                                            <span>
                                                @if ( $orderlang->status == 1)
                                                    {{__('word.Delivery is in progress')}} 
                                                    <a href="{{Route('dashboard.order.delivered',$order->id)}}" 
                                                        class="edit btn btn-success btn-sm">
                                                        <i class=" fa fa-home" ></i>
                                                    </a>
                                                @elseif ( $orderlang->status == 2)
                                                    {{__('word.Delivered')}} 
                                                    <a href="{{Route('dashboard.order.returned',$order->id)}}" 
                                                        class="edit btn btn-success btn-sm">
                                                        <i class="fa  fa-mail-reply-all " ></i>
                                                    </a>
                                                @elseif ( $orderlang->status == 3)
                                                    {{__('word.Returned')}} 
                                                @endif
                                            </span>
                                        </div>
                                    
                                    @endif
                                    
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group col-md-8">
                            <table class="table">
                                <tbody>
                                    @foreach ($orderitem as $item)
                                            @php
                                                    $booking=DB::table('bookings')->where('id',$item->booking_id)->first();

                                                    $product=DB::table('product_translations')->where('product_id',$booking->product_id)->where('locale',$setting->translate(app()->getlocale())->locale)->first();

                                                    $productmain=DB::table('products')->where('id',$booking->product_id)->first();
                                            @endphp


                                                <tr>
                                                    <th scope="row">                                                   
                                                        <img class="rounded" src="{{asset($productmain->image)}}"  width="40">
                                                    </th>
                                                    <td>
                                                        <div class="ml-2">
                                                            <a href="{{Route('product',$productmain->id)}}">
                                                                <span class="font-weight-bold d-block">{{$product->title}}</span>
                                                            </a>
                                                            <span class="spec">{!! $product->smallDesc !!}</span>
                                                        </div>
                                                    </td>
                                                    <td> <div class="d-flex flex-row align-items-center"><span class="d-block">{{$booking->date}}</span>
                                                        <span class="d-block ml-5 font-weight-bold">{{$product->price}}</span>
                                                    
                                                    </div></td>
                                                </tr>

                                    @endforeach 

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>



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

