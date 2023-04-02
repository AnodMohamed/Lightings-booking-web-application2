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
    <title> @yield('title' , $setting->translate(app()->getlocale())->title)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name ="description", content="@yield('meta_description',  $setting->content )">
    <meta name ="keywords", content="@yield('meta_keywords',  $setting->title )">
    <!-- Favicon -->
    <link href="{{ asset($setting->favicon) }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('website') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->

    @if ($setting->translate(app()->getlocale())->title == 'English') 
        <link href="{{ asset('website') }}/css/style.css" rel="stylesheet">
    @elseif ($setting->translate(app()->getlocale())->title == 'العربية') 
        <link href="{{ asset('website') }}/css/stylear.css" rel="stylesheet">
    @endif
</head>

<body>


    <!-- Navbar Start -->
    <div class="container-fluid p-0" 
        @if ($setting->translate(app()->getlocale())->title == 'العربية') 
        style="direction: rtl;"
        @endif
    >
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="{{route('index')}}" class="nav-item nav-link ">{{ __('word.home') }}</a>
                    @foreach ($categories as $category)
                        <div class="nav-item dropdown">
                            <a  @if (count($category->children) == 0) href="{{Route('category',$category->id)}}" @else href='#' @endif class="nav-link  @if (count($category->children) > 0) dropdown-toggle  @endif"
                                @if(count($category->children) > 0)  data-toggle="dropdown" @endif
                                 >{{ $category->title }}</a>
                            @if (count($category->children) > 0)
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach ($category->children as $child)
                                        <a href="{{Route('category',$child->id)}}" class="dropdown-item">{{ $child->title }}</a>
                                    @endforeach


                                </div>
                            @endif
                        </div>
                    @endforeach
                    @if (Auth::check())
                        @if (Auth::user()->status == "admin")
                            <a href="{{route('dashboard.settings')}}" class="nav-item nav-link ">{{ __('word.dashboard') }}</a>
                        @endif
                         <!-- Authentication -->
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-item nav-link active">{{ __('word.logout') }}</button>
                        </form>

                    @else
                        <a href="{{ route('login')}}"  class="nav-item nav-link active">{{ __('word.login') }}</a>
                        <a href="{{ route('register')}}" class="nav-item nav-link active">{{ __('word.register') }}</a>

                    @endif
                </div>




      
                
                <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                    <a class="nav-link  nav-link" href="{{route('product.cart.shopping')}}" >
                        <span class="hidden-md-down"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    </a>
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <h1><i class="fa-solid fa-cart-shopping"></i></h1>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach

                    </div>


                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('body')





    <!-- Footer Start -->
    <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5"  
        @if ($setting->translate(app()->getlocale())->title == 'العربية') 
            style="direction: rtl;"
        @endif
    >
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5">
                <a href="index.html" class="navbar-brand">
                    <img src="{{ asset($setting->logo) }}" alt="" style="height: 70px">
                </a>
                <p>{!! $setting->translate(app()->getlocale())->content !!}</p>
                <div class="d-flex justify-content-start mt-4">

                    @if ($setting->facebook != '')
                        <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                            href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                    @endif

                    @if ($setting->instagram != '')
                        <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                            href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                    @endif

                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">{{ __('word.categories') }}</h4>
                <div class="d-flex flex-wrap m-n1">
                    @foreach ($categories as $category)
                        <a href="{{Route('category',$category->id)}}" class="btn btn-sm btn-outline-secondary m-1">{{ $category->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="#">{{__('word.Lightings booking')}}</a>. {{__('word.All Rights Reserved')}}.

            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
           {{__('word.Designed by Rania Munir')}}</a>
        </p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('website') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('website') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('website') }}/mail/jqBootstrapValidation.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('website') }}/js/main.js"></script>
</body>

</html>
