@extends('layouts.dashboard')

@section('body')
        <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a  href="{{route('dashboard.index')}}">{{__('word.dashboard')}}</a></li>
            </li>
            <li class="breadcrumb-item active">{{__('word.settings')}}</li>

        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form action="{{Route('dashboard.settings.update',$setting)}}" method="post" enctype="multipart/form-data">
                        
                        @csrf

                        <div class="card">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-header">
                                <strong>{{__('word.settings')}}</strong>
                            </div>
                            <div class="card-block">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.logo') }}</label>
                                            <img src="{{asset($setting->logo)}}" alt="" style="height: 50px">
                                        </div>  
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.favicon') }}</label>
                                            <img src="{{asset($setting->favicon)}}" alt="" style="height: 50px">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.logo') }}</label>
                                            <input type="file" name="logo" class="form-control" placeholder="{{ __('words.logo') }}" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.favicon') }}</label>
                                            <input type="file" name="favicon" class="form-control"
                                                placeholder="{{ __('words.favicon') }}" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.facebook') }}</label>
                                            <input  type="text" name="facebook" class="form-control"
                                                placeholder="{{ __('word.facebook') }}" value="{{ $setting->facebook }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.instagram') }}</label>
                                            <input  type="text" name="instagram" class="form-control"
                                                placeholder="{{ __('word.instagram') }}" value="{{ $setting->instagram }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.phone') }}</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="{{ __('word.phone') }}" value="{{ $setting->phone }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('word.email') }}</label>
                                            <input type="text" name="email" class="form-control"
                                                placeholder="{{ __('word.email') }}" value="{{ $setting->email }}">>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <strong>{{__('word.translations')}}</strong>
                            </div>
                            
                            <div class="card-block">
                                
                                <ul class="nav nav-tabs" role="tablist">

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
                                                {{$lang}}

                                                <div class="form-group mt-3 col-md-12">
                                                    <label>{{ __('word.title') }} </label>
                                                    <input type="text" name="{{$key}}[title]" class="form-control"
                                                        placeholder="{{ __('word.title') }}"   value="{{$setting->translate($key)->title}}">
                                                </div>
    
                                                <div class="form-group col-md-12">
                                                    <label>{{ __('word.content') }}</label>
                                                    <textarea name="{{$key}}[content]" class="form-control" id="editor" cols="30" rows="10">{{$setting->translate($key)->content}}</textarea>
                                                </div>
    
    
                                                <div class="form-group col-md-12">
                                                    <label>{{ __('word.address') }}</label>
                                                    <input type="text"name="{{$key}}[address]" class="form-control"  value="{{ $setting->translate($key)->address }}">
                                                </div>
                                            </div>
                                        @endforeach
    
                                    </div>

                               
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                {{ __('word.submit') }}</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                {{ __('word.reset') }}</button>
                        </div>
                    </form>
                </div>
                <!--/.row-->

            </div>
        </div>
        <!-- /.conainer-fluid -->

    </main>
    
@endsection