@extends("frontend.Layouts.master")

@section('title')
    {{ __('words.showProAll') }}
@endsection

@section("content")
<div class="top"></div>
<div class="product-section mt-100 mb-100">
    <div class="container">
        @if(Session()->get('addcart'))
            <div class="alert alert-success fade show addcart-alert" role="alert" style="text-align:center">{{ Session()->get('addcart') }}</div>
        @endif
        <script>
            if (document.querySelector('.addcart-alert')) {
                document.querySelectorAll('.addcart-alert').forEach(function($el) {
                setTimeout(() => {
                    $el.classList.remove('show');
                }, 1500);
                });
            }
        </script>
        {{ session()->forget('addcart') }}
        <div class="row">
        </div>
        <div class="row">
            @foreach (DB::table('categories')->get()->where('parent','0')->whereNull('deleted_at') as $cat)
                @if (Session::get('lang') == 'ar')
                    <div class=" text-center w-100 fa-3x font-weight-bold mb-3">{{ $cat->nameAr }}</div>
                @else
                    <div class=" text-center w-100 fa-3x font-weight-bold mb-3">{{ $cat->nameEn }}</div>
                @endif
                @foreach (DB::table('prodecuts')->get()->where('categoryId',$cat->id)->whereNull('deleted_at') as $show)
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
                            <button onclick="window.location.href = '{{ route('cart.add',$show->id) }}'" class="cart-btn"><i class="fas fa-shopping-cart"></i> {{ __('words.addToCart') }}</button>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
