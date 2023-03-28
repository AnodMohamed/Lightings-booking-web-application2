@extends('layouts.dashboard')

@section('body')

<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('word.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{__('word.dashboard')}}</a>
        </li>
        <li class="breadcrumb-item active">{{__('word.products')}}</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;{{__('word.dashboard')}}</a>
                <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;{{__('word.products')}}</a>
            </div>
        </li>
    </ol>


    {{-- {{dd($setting)}} --}}

    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{__('word.products')}}
                </div>

                @if (session('success'))
                    <div id="successMessage" class="alert alert-success"  style="display: none;">
                        {{ session('success') }}
                    </div>
                @endif
            
                <div class="card-block">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th>{{__('word.title')}}</th>
                                <th>{!! __('word.smallDesc') !!}</th>
                                <th>{{__('word.price')}}</th>
                                <th>{{__('word.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</main>
{{-- delete --}}
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ Route('dashboard.products.delete') }}" method="POST">
            <div class="modal-content">

                <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <p>{{ __('word.sure delete') }}</p>
                        @csrf
                        <input type="hidden" name="id" id="id">
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
                        data: 'smallDesc',
                        name: 'smallDesc'
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

