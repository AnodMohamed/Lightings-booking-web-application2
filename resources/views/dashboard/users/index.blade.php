@extends('layouts.dashboard')

@section('body')

     <!-- Main content -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('word.dashboard') }}</li>
            <li class="breadcrumb-item"><a href="#">{{ __('word.dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active">داشبرد</li>
        </ol>


        <div class="container-fluid">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('word.users') }}
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('word.username') }}</th>
                                    <th>{{ __('word.email') }}</th>
                                    <th>{{ __('word.status') }}</th>
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


@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.users.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status',
                        name: 'status',
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
@endpush
