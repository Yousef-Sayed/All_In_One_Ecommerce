@extends("frontend.Layouts.master")

@section('title')
    {{ __('words.resultSearch') }}
@endsection

@section("content")
<div class="top"></div>
<div class="product-section mt-100 mb-100">
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            @foreach ($prodectsSearch as $show)
                <div class="col-lg-4 col-md-6 text-center">
                    <a href="#" class="single-product-item SPIS">
                        <div class="product-image">
                            <img src="{{ asset($show->image) }}" alt="">
                        </div>
                        @if (Session::get('lang') == 'ar')
                            <h3 class="TP">{{ $show->nameAr }}</h3>
                            <p class="catDiscriptin DP">{{ $show->descriptionAr }}</p>
                        @else
                            <h3 class="TP mt-2 mb-2">{{ $show->nameEn }}</h3>
                            <p class="catDiscriptin DP">{{ $show->descriptionEn }}</p>
                        @endif
                        <p class="product-price">{{ $show->price }} {{ __('words.currency') }}</p>
                        <button onclick="window.location.href = 'cart.html'" class="cart-btn"><i class="fas fa-shopping-cart"></i> {{ __('words.addToCart') }}</button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

