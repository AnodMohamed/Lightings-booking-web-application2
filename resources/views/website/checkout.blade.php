@extends('layouts.website')

@section('body')
 <!-- Breadcrumb Start -->
 <div class="container-fluid pt-3" 
    @if ($setting->translate(app()->getlocale())->title == 'العربية') 
        style="direction: rtl;"
    @endif
    >
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="{{route('index')}}"> {{ __('word.home') }}</a>
            <a class="breadcrumb-item" href="{{route('index')}}"> {{__('word.shopping cart')}}</a>
            <span class="breadcrumb-item active"> {{__('word.checkout')}}</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-white">
                <div class="container mt-5 p-3 rounded cart">
                    {{-- action="{{ Route('product.cart.checkout.store') }}" --}}
                    {{-- data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" --}}
                    <form action="{{ Route('website.product.cart.checkout.store') }}" method="post" 
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        @if ($setting->translate(app()->getlocale())->title == 'العربية') 
                            style="direction: rtl;"
                        @endif
                        >
                        @csrf
                        @method('POST')

                        <input type="hidden" id="user_id" value="{{Auth::user()->id}}" name='user_id' />

                        <label class="form-label" for="mobile">{{ __('word.mobile') }}</label>
                        <input type="text" id="mobile" class="form-control" value="" name='mobile' placeholder="05X XXX XXXX"/>

                        @error('mobile')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror
                    
                        <label class="form-label" for="email">{{ __('word.email') }} </label>
                        <input type="email" id="email" class="form-control" value="" name='email' placeholder="{{ __('word.email') }}"/>

                        @error('email')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror

                        <label class="form-label" for="zipcode">{{__('word.zipcode')}}</label>
                        <input type="text" id="zipcode" class="form-control" value="" name='zipcode'  placeholder="{{__('word.zipcode')}}"/>

                        @error('zipcode')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror

                        <label class="form-label" for="support">{{__('word.support')}}</label>
                        <select id="support" class="browser-default custom-select form-control" name="support">
                            <option selected>{{__('word.support')}}</option>
                            <option value='0' >{{__('word.no')}}</option>
                            <option value='1' >{{__('word.yes')}}</option>
                        </select>
                        @error('support')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror

                        <label class="form-label" for="form12">{{__('word.card number')}}</label>
                        <input type="text" id="" class="form-control" name="card_no"  placeholder="{{__('word.card number')}}"/>

                        @error('card_no')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror
                        <label class="form-label" for="form12">{{__('word.expiry month')}}</label>
                        <input type="text" class="form-control" placeholder="MM" name="exp_month">
                        @error('exp_month')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror
                        
                        <label class="form-label" for="form12">{{__('word.expiry year')}}</label>
                        <input type="text" class="form-control" placeholder="YYYY"  name="exp_year">
                        @error('exp_year')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror

                        <label class="form-label" for="form12">{{__('word.CVC')}} </label>
                        <input type="password"  class="form-control" placeholder="CVC"  name="cvc">
                        @error('cvc')
                            <p class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> {{$message}}</p>
                        @enderror


                        <div class="card-block my-3">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach (config('app.languages') as $key => $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->index == 0) active @endif"
                                            id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                    </li>
                                @endforeach

                             

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach (config('app.languages') as $key => $lang)
                                    <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                    id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                        <br>
                                        <div class="form-group mt-3 col-md-12">
                                            <label>{{ __('word.firstname') }} - {{ $lang }} </label>
                                            <input type="text" name="{{$key}}[firstname]" class="form-control"
                                                placeholder="{{ __('word.firstname') }}" required minlength="3" maxlength="50">
                                        </div>

                                        <div class="form-group mt-3 col-md-12">
                                            <label>{{ __('word.lastname') }} </label>
                                            <input type="text" name="{{$key}}[lastname]" class="form-control"
                                                placeholder="{{ __('word.lastname') }}" required minlength="3" maxlength="50">
                                        </div>

                                        <div class="form-group mt-3 col-md-12">
                                            <label>{{ __('word.address') }} </label>
                                            <input type="text" name="{{$key}}[address]" class="form-control"
                                                placeholder="{{ __('word.address') }}" required minlength="3" maxlength="50">
                                        </div>

                                        
                                    </div>
                                @endforeach

                            </div>



                        </div>

                     
                        <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton">{{__('word.checkout')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->

@endsection
