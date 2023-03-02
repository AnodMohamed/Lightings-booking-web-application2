@extends('layouts.dashboard')

@section('body')
        <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">خانه</li>
            <li class="breadcrumb-item"><a href="#">مدیریت</a>
            </li>
            <li class="breadcrumb-item active">داشبرد</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;داشبرد</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;تنظیمات</a>
                </div>
            </li>
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
                                            <input type="file" name="logo" class="form-control" placeholder="Enter logo.." >
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

                                <!----   
                                <div class="tab-content">
                                    <div class="tab-pane active" id="timeline" role="tabpanel">
                                        <div class="callout m-a-0 p-y-h text-muted text-xs-center bg-faded text-uppercase">
                                            <small><b>Today</b>
                                            </small>
                                        </div>
                                        <hr class="transparent m-x-1 m-y-0">
                                        <div class="callout callout-warning m-a-0 p-y-1">
                                            <div class="avatar pull-xs-right">
                                                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                            </div>
                                            <div>Meeting with
                                                <strong>Lucas</strong>
                                            </div>
                                            <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                                            <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                                        </div>
                                        <hr class="m-x-1 m-y-0">
                                        <div class="callout callout-info m-a-0 p-y-1">
                                            <div class="avatar pull-xs-right">
                                                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                            </div>
                                            <div>Skype with
                                                <strong>Megan</strong>
                                            </div>
                                            <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
                                            <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line</small>
                                        </div>
                                        <hr class="transparent m-x-1 m-y-0">
                                        <div class="callout m-a-0 p-y-h text-muted text-xs-center bg-faded text-uppercase">
                                            <small><b>Tomorrow</b>
                                            </small>
                                        </div>
                                        <hr class="transparent m-x-1 m-y-0">
                                        <div class="callout callout-danger m-a-0 p-y-1">
                                            <div>New UI Project -
                                                <strong>deadline</strong>
                                            </div>
                                            <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
                                            <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                                            <div class="avatars-stack m-t-h">
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="m-x-1 m-y-0">
                                        <div class="callout callout-success m-a-0 p-y-1">
                                            <div>
                                                <strong>#10 Startups.Garden</strong>Meetup</div>
                                            <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                                            <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                                        </div>
                                        <hr class="m-x-1 m-y-0">
                                        <div class="callout callout-primary m-a-0 p-y-1">
                                            <div>
                                                <strong>Team meeting</strong>
                                            </div>
                                            <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
                                            <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                                            <div class="avatars-stack m-t-h">
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                                <div class="avatar avatar-xs">
                                                    <img src="img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="m-x-1 m-y-0">
                                    </div>
                                    <div class="tab-pane p-a-1" id="messages" role="tabpanel">
                                        <div class="message">
                                            <div class="p-y-1 p-b-3 m-r-1 pull-left">
                                                <div class="avatar">
                                                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                    <span class="avatar-status tag-success"></span>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lukasz Holeczek</small>
                                                <small class="text-muted pull-left m-t-q">1:52 PM</small>
                                            </div>
                                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                        </div>
                                        <hr>
                                        <div class="message">
                                            <div class="p-y-1 p-b-3 m-r-1 pull-left">
                                                <div class="avatar">
                                                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                    <span class="avatar-status tag-success"></span>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lukasz Holeczek</small>
                                                <small class="text-muted pull-left m-t-q">1:52 PM</small>
                                            </div>
                                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                        </div>
                                        <hr>
                                        <div class="message">
                                            <div class="p-y-1 p-b-3 m-r-1 pull-left">
                                                <div class="avatar">
                                                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                    <span class="avatar-status tag-success"></span>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lukasz Holeczek</small>
                                                <small class="text-muted pull-right m-t-q">1:52 PM</small>
                                            </div>
                                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                        </div>
                                        <hr>
                                        <div class="message">
                                            <div class="p-y-1 p-b-3 m-r-1 pull-left">
                                                <div class="avatar">
                                                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                    <span class="avatar-status tag-success"></span>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lukasz Holeczek</small>
                                                <small class="text-muted pull-right m-t-q">1:52 PM</small>
                                            </div>
                                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                        </div>
                                        <hr>
                                        <div class="message">
                                            <div class="p-y-1 p-b-3 m-r-1 pull-left">
                                                <div class="avatar">
                                                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                                                    <span class="avatar-status tag-success"></span>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lukasz Holeczek</small>
                                                <small class="text-muted pull-right m-t-q">1:52 PM</small>
                                            </div>
                                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-a-1" id="settings" role="tabpanel">
                                        <h6>Settings</h6>
                                        <div class="aside-options">
                                            <div class="clearfix m-t-2">
                                                <small><b>Option 1</b>
                                                </small>
                                                <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                                                    <input type="checkbox" class="switch-input" checked="">
                                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                                            </div>
                                        </div>
                                        <div class="aside-options">
                                            <div class="clearfix m-t-1">
                                                <small><b>Option 2</b>
                                                </small>
                                                <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                                                    <input type="checkbox" class="switch-input">
                                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                            <div>
                                                <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                                            </div>
                                        </div>
                                        <div class="aside-options">
                                            <div class="clearfix m-t-1">
                                                <small><b>Option 3</b>
                                                </small>
                                                <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                                                    <input type="checkbox" class="switch-input">
                                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="aside-options">
                                            <div class="clearfix m-t-1">
                                                <small><b>Option 4</b>
                                                </small>
                                                <label class="switch switch-text switch-pill switch-success switch-sm pull-right">
                                                    <input type="checkbox" class="switch-input" checked="">
                                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>System Utilization</h6>
                                        <div class="text-uppercase m-b-q m-t-2">
                                            <small><b>CPU Usage</b>
                                            </small>
                                        </div>
                                        <progress class="progress progress-xs progress-info m-a-0" value="25" max="100">25%</progress>
                                        <small class="text-muted">348 Processes. 1/4 Cores.</small>
                                        <div class="text-uppercase m-b-q m-t-h">
                                            <small><b>Memory Usage</b>
                                            </small>
                                        </div>
                                        <progress class="progress progress-xs progress-warning m-a-0" value="70" max="100">70%</progress>
                                        <small class="text-muted">11444GB/16384MB</small>
                                        <div class="text-uppercase m-b-q m-t-h">
                                            <small><b>SSD 1 Usage</b>
                                            </small>
                                        </div>
                                        <progress class="progress progress-xs progress-danger m-a-0" value="95" max="100">95%</progress>
                                        <small class="text-muted">243GB/256GB</small>
                                        <div class="text-uppercase m-b-q m-t-h">
                                            <small><b>SSD 2 Usage</b>
                                            </small>
                                        </div>
                                        <progress class="progress progress-xs progress-success m-a-0" value="10" max="100">10%</progress>
                                        <small class="text-muted">25GB/256GB</small>
                                    </div>
                                </div>--->
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