@extends('layouts.dashboard')

@section('body')

<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('word.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{__('word.dashboard')}}</a>
        </li>
        <li class="breadcrumb-item active">{{__('word.appointments')}}</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;{{__('word.dashboard')}}</a>
                <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;{{__('word.appointments')}}</a>
            </div>
        </li>
    </ol>


    {{-- {{dd($setting)}} --}}

    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{__('word.appointments')}}
                </div>

                @if (session('success'))
                    <div id="successMessage" class="alert alert-success"  style="display: none;">
                        {{ session('success') }}
                    </div>
                @endif
            
                @if(count($bookings) > 0)

                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>
                                    <th>{{__('word.date')}}</th>
                                    <th>{{__('word.username')}}</th>
                                    <th>{{__('word.status')}}</th>
                                    <th>{{__('word.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            {{ $booking->date }}
                                        </td>
                                        <td>
                                            @if ($booking->user_id == Null)
                                                {{__('word.null')}}
                                            @else
                                                @php
                                                    $user = DB::table('users')->where('id',$booking->user_id)->first();
                                                @endphp

                                                {{ $user->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($booking->status == 0)
                                                {{__('word.reserved')}}
                                            @else
                                                {{__('word.available')}}

                                            @endif
                                        </td>
                                        <td>
                                            <a id="deleteBtn" data-id="{{ $booking->id }}" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>
                                            {{-- delete --}}
                                            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ Route('dashboard.booking.delete') }}" method="POST">
                                                    <div class="modal-content">

                                                        <div class="modal-body">
                                                            @csrf
                                                            <div class="form-group">
                                                                <p>{{ __('word.sure delete') }}</p>

                                                                @csrf
                                                                <input type="hidden" name="id" id="id" value="{{  $booking->id }}">
                                                            </div>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('word.close') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('word.delete') }} </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog /-->
                                            </div>
                                            {{-- delete --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                @else
                    <div class="alert alert-warning">
                       {{ __('word.no booking')}}
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

