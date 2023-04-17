@extends('layouts.dashboard')

@section('body')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a  href="{{route('dashboard.index')}}"> {{__('word.dashboard')}}</a></li>
            <li class="breadcrumb-item active">{{ __('word.edit product') }}</li>
        </ol>


        <div class="container-fluid">

            <div class="animated fadeIn">
                <form action="{{ Route('dashboard.product.update' , $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                <strong>{{ __('word.products') }}</strong>
                            </div>
                            <div class="card-block">


                                <div class="form-group col-md-12">
                                    <img src="{{asset($product->image)}}" alt="" style="height: 50px">
                                 </div>

                                <div class="form-group col-md-12">
                                    <label>{{ __('word.image') }}</label>
                                    <input type="file" name="image" class="form-control"
                                        placeholder="{{ __('word.image') }}" >
                                </div>



                                <div class="form-group col-md-12">
                                    <label>{{ __('word.category') }}</label>
                                    <select name="category_id" id="" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option  @selected($product->category_id == $category->id) value="{{ $category->id }}">{{ $category->title }}</option>
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
                                                    <input type="text" name="{{ $key }}[title]" class="form-control"
                                                        placeholder="{{ __('word.title') }}" value="{{$product->translate($key)->title}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>{{ __('word.smallDesc') }}</label>
                                                    <textarea name="{{ $key }}[smallDesc]" class="form-control" id="editor" cols="50" rows="10">{{$product->translate($key)->smallDesc}}</textarea>
                                                </div>


                                                <div class="form-group col-md-12">
                                                    <label>{{ __('word.content') }}</label>
                                                    <textarea name="{{ $key }}[content]" class="form-control" id="editor" cols="50" rows="10">{{$product->translate($key)->content}}</textarea>
                                                </div>
                                                

                                                <div class="form-group col-md-12">
                                                    <label>{{ __('word.price') }}</label>
                                                    <input type="text" name="{{ $key }}[price]" class="form-control" id="" value="{{$product->translate($key)->price}}"/>
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


                        </div>
                </form>
            </div>
        </div>

    </main>

@endsection
