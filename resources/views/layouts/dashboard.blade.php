<!DOCTYPE html>
<html 
    @if ($setting->translate(app()->getlocale())->title == 'English') 
    lang="en"
    dir='ltr'
    @elseif ($setting->translate(app()->getlocale())->title == 'العربية') 
    lang="ar"
    dir='rtl'
    @endif

>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $setting->translate(app()->getlocale())->content }}">
    <meta name="keyword" content="{{ $setting->translate(app()->getlocale())->title }}">
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}">
    <title>{{ $setting->translate(app()->getlocale())->title }}</title>
    <!-- Icons -->
    <link href="{{ asset('adminassets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminassets/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    
    @if ($setting->translate(app()->getlocale())->title == 'English') 

        <link href="{{ asset('adminassets/dest/style.css') }}" rel="stylesheet">

    @elseif ($setting->translate(app()->getlocale())->title == 'العربية') 

        <link href="{{ asset('adminassets/dest/stylear.css') }}" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">


</head>
<!-- BODY options, add following classes to body to change options
		1. 'compact-nav'     	  - Switch sidebar to minified version (width 50px)
		2. 'sidebar-nav'		  - Navigation on the left
			2.1. 'sidebar-off-canvas'	- Off-Canvas
				2.1.1 'sidebar-off-canvas-push'	- Off-Canvas which move content
				2.1.2 'sidebar-off-canvas-with-shadow'	- Add shadow to body elements
		3. 'fixed-nav'			  - Fixed navigation
		4. 'navbar-fixed'		  - Fixed navbar
	-->

<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <img class="navbar-brand"  
                 src="{{ asset($setting->logo) }}"
                style="
                    width: 155px;
                    height: 55px;
                    padding: 8px 16px;
                    padding: 0.5rem 1rem;
                    background-color: #fff;
                    background-repeat: no-repeat;
                    background-position: center center;
                    background-size: 70px auto;
                    border-bottom: 1px solid #cfd8dc;
                "     
            >
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
             
                <!--<li class="nav-item p-x-1">
                    <a class="nav-link" href="#">داشبورد</a>
                </li>
                <li class="nav-item p-x-1">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item p-x-1">
                    <a class="nav-link" href="#">Settings</a>
                </li>-->
            </ul>
            <ul class="nav navbar-nav hidden-md-down" 
                @if ($setting->translate(app()->getlocale())->title == 'English') 
                    style="direction: rtl; float: right;"
                @elseif ($setting->translate(app()->getlocale())->title == 'العربية') 
                    style="direction: ltr; float: left;"
                @endif
        
            >
            
                <li class="nav-item " style="margin-left: 10px !important">
                    {{ auth()->user()->name }}({{ auth()->user()->status }})</li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('adminassets/img/avatars/default.png') }}" class="img-avatar">
                      
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('index')}}"><i class="fa fa-home"></i> {{__('word.home')}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('word.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                        
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach

                    </div>
                </li>

                
               
            </ul>
       
        </div>
    </header>
    @include('layouts.sidebar')

    @yield('body')

    <aside class="aside-menu">
       
        
    </aside>
    

    <footer class="footer">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="#">{{__('word.Lightings booking')}}</a>. {{__('word.All Rights Reserved')}}.

            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
           {{__('word.Designed by Rania Munir')}}</a>
        </p>
    </footer>
  <!-- Bootstrap and necessary plugins -->
  <script src="{{ asset('adminassets/js/libs/jquery.min.js') }}"></script>
  <script src="{{ asset('adminassets/js/libs/tether.min.js') }}"></script>
  <script src="{{ asset('adminassets/js/libs/bootstrap.min.js') }}"></script>
  <script src="{{ asset('adminassets/js/libs/pace.min.js') }}"></script>

  <!-- Plugins and scripts required by all views -->
  <script src="{{ asset('adminassets/js/libs/Chart.min.js') }}"></script>

  <!-- CoreUI main scripts -->
  <script src="{{ asset('adminassets/js/app.js') }}"></script>

  <!-- Plugins and scripts required by this views -->
  <!-- Custom scripts required by this view -->
  <script src="{{ asset('adminassets/js/views/main.js') }}"></script>

  <!-- Grunt watch plugin -->
  <script src="{{ asset('adminassets') }}/livereload.js"></script>

  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
  <script>
      var allEditors = document.querySelectorAll('#editor');
      for (var i = 0; i < allEditors.length; ++i) {
          ClassicEditor.create(allEditors[i]);
      }

      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
      });
  </script>


  @stack('javascripts')
   </body>
    
</html>