@push('style')
@vite(['resources/js/app.js'])

    
@endpush
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
                <span class="breadcrumb-item active"> {{__('word.profile')}}</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 bg-white">
                    <div class="container mt-5 p-3 rounded cart">
                        <div>
                            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')

                                    <x-section-border />
                                @endif

                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.update-password-form')
                                    </div>

                                    <x-section-border />
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection