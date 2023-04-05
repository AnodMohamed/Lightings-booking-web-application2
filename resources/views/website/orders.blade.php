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
                <span class="breadcrumb-item active">{{ __('word.My orders') }}</span>
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
                        <div class="overlay position-relative bg-light" 
                            @if ($setting->translate(app()->getlocale())->title == 'العربية') 
                                style="direction: rtl;"
                            @endif
                        >


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
                                        @foreach ($myorders as $order)
                                            {{-- {{ $order->id}} --}}
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
                                                    <a href="{{Route('website.orders.show',$order->id)}}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
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
    <!-- News With Sidebar End -->
@endsection


@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({

            });

        });


    </script>



@endpush