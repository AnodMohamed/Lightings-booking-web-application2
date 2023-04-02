@extends('layouts.website')

@section('body')

 <!--Carousel Start -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
    <div class="carousel-inner">
      <div class="carousel-item active" style="height: 92vh;">
        <img class="d-block w-100 h-100" src="{{asset('website/img/carousel-1.png')}}" alt="First slide">
      </div>
      <div class="carousel-item " style="height: 92vh;">
        <img class="d-block w-100 h-100" src="{{asset('website/img/carousel-2.png')}}" alt="First slide">
      </div>
      <div class="carousel-item " style="height: 92vh;">
        <img class="d-block w-100 h-100" src="{{asset('website/img/carousel-3.png')}}" alt="First slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
 <!--Carousel end -->

 <!-- Top News Slider Start -->
 <div class="container-fluid py-3" >
    <div class="container">
        <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative" >
            @foreach ($lastFiveProducts as $product)
            <div class="d-flex w-100"  
                @if ($setting->translate(app()->getlocale())->title == 'العربية') 
                    style="direction: rtl;"
                @endif
            >
                <img src="{{asset($product->image)}}" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="d-flex align-items-center bg-light px-3 w-100">
                    <a class="text-secondary font-weight-semi-bold" href="">{{$product->title}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Top News Slider End -->


<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="">
        <div class="row">
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    @foreach ($lastFiveProducts as $product)
                     <div class="position-relative overflow-hidden" style="height: 435px;">
                        <img class="img-fluid h-100" src="{{asset($product->image)}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1">
                                <a class="text-white" href="{{Route('category',$product->category->id)}}">{{$product->category->title}}</a>
                                <span class="px-2 text-white">/</span>
                                <a class="text-white" href="">{{$product->created_at->format('Y-m-d')}}</a>
                            </div>
                            <a class="h2 m-0 text-white font-weight-bold" href="{{Route('product',$product->id)}}">{{$product->title}}</a>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">{{ __('word.categories') }}</h3>
                </div>
                @foreach ($categories as $category)
                <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                    <img class="img-fluid w-100 h-100" src="{{asset($category->image)}}" style="object-fit: cover;">
                    <a href="{{Route('category',$category->id)}}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                       {{$category->title}}
                    </a>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->





<!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            @foreach ($categories_with_products as $category)
                
            @if (count($category->products)>0)
                
            
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">{{$category->title}}</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    @foreach ($category->products as $product)
                        
                   
                    <div class="position-relative">
                        <img class="img-fluid w-100" src="{{asset($product->image)}}" style="object-fit: cover;">
                        <div class="overlay position-relative bg-light">
                            <div class="mb-2" style="font-size: 13px;">
                                <a href="{{Route('category',$category->id)}}">{{$category->title}}</a>
                                {{-- href="{{Route('category',$category->id)}}" --}}
                                <span class="px-1">/</span>
                                <span>{{$product->created_at->format('Y, M-d')}}</span>
                            </div>
                            <a class="h4 m-0" href="{{Route('product',$product->id)}}">{{$product->title}}</a>
                            {{-- href="{{Route('product',$product->id)}}" --}}
                        </div>
                    </div>
                    @endforeach
                  
                </div>
            </div>
            @endif
            @endforeach
           
        </div>
    </div>
</div>
</div>
<!-- Category News Slider End -->

    
@endsection
