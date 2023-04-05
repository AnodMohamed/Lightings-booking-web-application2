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

                @if (session('success'))
                    <div id="successMessage" class="alert alert-success"  style="display: none;">
                        {{ session('success') }}
                    </div>
                @endif
            
                @if(count($orders) > 0)

                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('word.total')}}</th>
                                    <th>{{__('word.mobile')}}</th>
                                    <th>{{__('word.email')}}</th>
                                    <th>{{__('word.zipcode')}}</th>
                                    <th>{{__('word.support table')}}</th>
                                    <th>{{__('word.action')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->id }}
                                        </td>
                                        <td>
                                            {{ $order->total }}
                                        </td> 
                                        <td>
                                            {{ $order->mobile }}
                                        </td>
                                        <td>
                                            {{ $order->email }}
                                        </td>
                                        <td>
                                            {{ $order->zipcode }}
                                        </td>
                                        <td>
                                            @if ( $order->support == 0)
                                                {{__('word.no')}} 
                                            @else
                                                {{__('word.yes')}} 
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{Route('dashboard.order.show',$order->id)}}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                @else
                    <div class="alert alert-warning">
                       {{ __('word.no orders')}}
                    </div>
                @endif
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

