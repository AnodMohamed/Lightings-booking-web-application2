@extends('layouts.auth')

@section('body')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 m-x-auto pull-xs-none vamiddle">
                            <div class="card-group ">
                                <div class="card p-a-2">
                                    <x-authentication-card>
                                        <div class="" style="color: red"> 
                                            <x-validation-errors class="mb-4" />
                                        </div>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div>
                                                <x-label class="text-muted" for="name" value="{{__('word.username') }}" />
                                                <x-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                            </div>
                                            <div>
                                                <x-label class="text-muted" for="email" value="{{__('word.email') }}" />
                                                <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                            </div>
                                            <div>
                                                <x-label class="text-muted" for="password" value="{{__('word.password') }}" />
                                                <x-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
                                            </div>
                                            <div>
                                                <x-label class="text-muted" for="password_confirmation" value="{{__('word.confirmPassword') }}" />
                                                <x-input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" />

                                            </div>
                                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                                <div class="mt-4">
                                                    <x-label for="terms">
                                                        <div class="flex items-center">
                                                            <x-checkbox name="terms" id="terms" required />
                            
                                                            <div class="ml-2">
                                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                                                ]) !!}
                                                            </div>
                                                        </div>
                                                    </x-label>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="flex items-center justify-end mt-4">
                                                        <button type="button" class="btn btn-link p-x-0  btn-primary p-x-2">
                                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                                                {{ __('word.alreadyRegistered') }}
                                                            </a>
                                                        </button>

                                                        <x-button class="ml-4 btn btn-primary p-x-2">
                                                            {{ __('word.register') }}
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </div>
                            
                                        </form>

                                    </x-authentication-card>
                                </div>
                                <div class="card card-inverse card-primary p-y-3" style="width:44%">
                                    <div class="card-block text-xs-center">
                                        <div>
                                            <h1>
                                                {{ __('word.register') }}
                                            </h1>
                                            <x-slot name="logo">
                                                {{---
                                                <x-authentication-card-logo />
                                                ---}}
                                            </x-slot>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection






