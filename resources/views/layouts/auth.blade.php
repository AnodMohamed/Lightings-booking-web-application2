<!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>CoreUI Bootstrap 4 Admin Template</title>
    <!-- Icons -->
    <link href="{{asset('adminassets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminassets/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('adminassets/dest/style.css')}}" rel="stylesheet">
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
    <header class="navbar" >
        <div class="container-fluid" style="direction: ltr">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="#"></a>

            <ul class="nav navbar-nav  hidden-md-down">
                <li class="nav-item" >

                    <a class="nav-link " href="{{route('index')}}" >
                        الصفحة الرئسية
                    </a>
                </li>
            </ul>
        </div>
    </header>



    @yield('body')

 

    <footer class="footer">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="#">{{__('word.Lightings booking')}}</a>. {{__('word.All Rights Reserved')}}.

            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
           {{__('word.Designed by Rania Munir')}}</a>
        </p>
    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('adminassets/js/libs/jquery.min.js')}}"></script>
    <script src="{{asset('adminassets/js/libs/tether.min.js')}}"></script>
    <script src="{{asset('adminassets/js/libs/bootstrap.min.js')}}"></script>
    <script src="{{asset('adminassets/js/libs/pace.min.js')}}"></script>
    
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('adminassets/js/libs/Chart.min.js')}}"></script>
    
    <!-- CoreUI main scripts -->
    
    <script src="{{asset('adminassets/js/app.js')}}"></script>
    
    <!-- Plugins and scripts required by this views -->
    <!-- Custom scripts required by this view -->
    <script src="{{asset('adminassets/js/views/main.js')}}"></script>
    
    <!-- Grunt watch plugin -->
    <script src="//localhost:35729/livereload.js"></script>
   </body>
    
</html>