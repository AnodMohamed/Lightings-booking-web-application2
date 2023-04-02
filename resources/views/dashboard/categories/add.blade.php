
@extends('layouts.dashboard')

@section('body')

    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a  href="{{route('dashboard.index')}}"> {{__('word.dashboard')}}</a></li>
            <li class="breadcrumb-item active">{{ __('word.add category') }}</li>
        </ol>


        <div class="container-fluid">

            <div class="animated fadeIn">
                <form action="{{ Route('dashboard.category.store') }}" method="post" enctype="multipart/form-data">
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
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('word.add category') }}</strong>
                            </div>
                            <div class="card-block">



                                <div class="form-group col-md-12">
                                    <label>{{ __('word.image') }}</label>
                                    <input type="file" name="image" class="form-control" placeholder="{{ __('word.image') }}"
                                    required  accept="image/png, image/jpeg">
                                </div>


                            
                                <div class="form-group col-md-12">
                                    <label>{{ __('word.parent') }}</label>
                                    <select name="parent" id="" class="form-control" required>
                                        <option value="0"> {{ __('word.parent') }} </option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <strong>{{ __('word.translations') }}</strong>
                                </div>
                                <div class="card-block">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        @foreach (config('app.languages') as $key => $lang)
                                            <li class="nav-item">
                                                <a class="nav-link @if ($loop->index == 0) active @endif"
                                                    id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                                    aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @foreach (config('app.languages') as $key => $lang)
                                            <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                                id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                                <br>
                                                <div class="form-group mt-3 col-md-12">
                                                    <label>{{ __('word.title') }} - {{ $lang }}</label>
                                                    <input type="text" name="{{$key}}[title]" class="form-control"
                                                        placeholder="{{ __('word.title') }}" required minlength="3" maxlength="50">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>{{ __('word.content') }}</label>
                                                    <textarea name="{{$key}}[content]" class="form-control"  cols="30" rows="10" required minlength="3" maxlength="300"></textarea>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>



                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                        {{ __('word.submit') }}</button>
                                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                        {{ __('word.reset') }}</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <main class="main">

@endsection
