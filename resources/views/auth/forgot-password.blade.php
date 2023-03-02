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
                                        @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('password.email') }}">
                                             @csrf
                            
                                            <div class="card-block">

                                                <div>
                                                    <x-label class="text-muted" for="email" value="{{__('word.email') }}" />
                                                    <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                </div>


                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="flex items-center justify-end mt-4">
                                                            <x-button class="ml-4 btn btn-primary p-x-2">
                                                                {{ __('word.email password reset link') }}
                                                            </x-button>
                                                        </div>
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
                                                {{ __('word.forgotyourpassword') }}
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