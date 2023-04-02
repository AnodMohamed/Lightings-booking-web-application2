
@extends('layouts.dashboard')

@section('body')

    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a  href="{{route('dashboard.index')}}"> {{__('word.dashboard')}}</a></li>
            <li class="breadcrumb-item active">{{ __('word.add appointment') }}</li>
        </ol>


        <div class="container-fluid">

            <div class="animated fadeIn">
                <form action="{{ Route('dashboard.booking.store') }}" method="post" >
                    @csrf
                    @method('POST')
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('error'))
                            <div id="ErrorMessage" class="alert alert-danger"  style="display: none;">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('word.add appointment') }}</strong>
                            </div>
                            <div class="card-block">
                                {{--date--}}
                                <div class="form-group col-md-12">
                                    <label>{{ __('word.date') }}</label>
                                    <input type="date" name="date" class="form-control " id="date"  >

                                </div>
                                
                                <input type="hidden" name="product_id" class="form-control " id="product_id" value="{{ $booking }}" >

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                        {{ __('word.submit') }}</button>
                                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                        {{ __('word.reset') }}</button>
                                </div>

                            </div>
                        </div>
                </form>
            </div>
        </div>

    </main>

@endsection


@push('javascripts')

    <script>
        $(document).ready(function() {
            // show the success message
            $('#ErrorMessage').show();

            // hide the success message after 3 seconds
            setTimeout(function() {
                $('#ErrorMessage').fadeOut('fast');
            }, 9000);
        });
    </script>

@endpush
