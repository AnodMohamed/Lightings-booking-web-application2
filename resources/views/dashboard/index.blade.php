@extends('layouts.dashboard')

@section('body')
     <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">{{__('word.dashboard')}}</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="fa fa-lightbulb-o" aria-hidden="true" style="font-size: 16px;"></i>
                                </div>
                                <h4 class="m-b-0">{{$countproducts}}</h4>
                                <h2>{{__('word.products')}}</h2>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:20px;">
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-info">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 16px;"></i>
                                </div>
                                <h4 class="m-b-0">{{$countorders}}</h4>
                                <h2>{{__('word.orders')}}</h2>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:20px;">
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-warning">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true" style="font-size: 16px;"></i>
                                </div>
                                <h4 class="m-b-0">{{$countbookings}}</h4>
                                <h2>{{__('word.available bookings')}}</h2>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:20px;">
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-danger">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="fa fa-money" aria-hidden="true" style="font-size: 16px;"></i>
                                </div>
                                <h4 class="m-b-0">{{$counttransactions}}</h4>
                                <h2>{{__('word.total transactions')}}</h2>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:20px;">
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                </div>
                <!--/row-->
            </div>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 " >
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{__('word.last six orders')}}
                        </div>
                        <div class="card-block " style="background: #fff;">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('word.total')}}</th>
                                    <th scope="col">{{__('word.mobile')}}</th>
                                    <th scope="col">{{__('word.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($last6orders as $order)
                                        <tr>
                                            <th scope="row">{{$order->id}}</th>
                                            <td>
                                                {{ $order->total }}
                                            </td> 
                                            <td>
                                                {{ $order->mobile }}
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
                    </div>

                    <div class="col-sm-12 col-lg-6 " >
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{__('word.last six products')}}
                        </div>
                        <div class="card-block " style="background: #fff;">
                            <table class="table " id="table_id">
                                <thead>
                                <tr>
                                    <th>{{__('word.title')}}</th>
                                    <th>{{__('word.price')}}</th>
                                    <th>{{__('word.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                  
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-fluid-->
    </main>
    
@endsection


@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.products.all') }}",
                columns: [
                    
                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });

        });

        $('#table_id tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>

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