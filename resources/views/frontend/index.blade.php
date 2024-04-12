@extends("frontend.Layouts.master")

@section('title')
    {{ __('words.home') }}
@endsection

@section("content")
    @extends('frontend.Layouts.slider')
    <script>
        @if (!is_null(session('sucess')))
            Swal.fire({
                position: "center-center",
                icon: "success",
                title: "{{ session('sucess') }}",
                showConfirmButton: false,
                timer: 3500,
            });
        @endif
    </script>

	<!-- category section -->
	<div id="category" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row w-100">
				<div class="w-100 text-center">
					<div class="section-title">
						<h3><span class="orange-text"></span> {{ __('words.categories') }}</h3>
						<p>{{ __('words.pCategory') }}</p>
					</div>
				</div>
			</div>

			<div class="row">
                @foreach (DB::table('categories')->get()->where('parent','0')->whereNull('deleted_at') as $category)
                    <div class="col-lg-4 col-md-6 text-center c mb-3 mt-3">
                        <a href="{{ route('show.category',$category->id) }}" class="single-category-item">
                            <div class="category-image">
                                <img src="{{ asset($category->image) }}" alt="">
                            </div>
                            @if (Session::get('lang'))
                                @if (Session::get('lang') == 'ar')
                                    <h3>{{ $category->nameAr }}</h3>
                                    <p class="catDiscriptin">{{ $category->discriptionAr }}</p>
                                @else
                                    <h3>{{ $category->nameEn }}</h3>
                                    <p class="catDiscriptin">{{ $category->discriptionEn }}</p>
                                @endif
                            @else
                                <h3>{{ $category->nameEn }}</h3>
                                <p class="catDiscriptin">{{ $category->discriptionEn }}</p>
                            @endif
                        </a>
				    </div>

                @endforeach
            </div>
		</div>
	</div>
	<!-- end category section -->

	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
    	<div class="container">
        	<div class="row clearfix">
            	<!--Image Column-->
            	<div class="image-column col-lg-6">
                	<div class="image">
                    	<div class="price-box">
                        	<div class="inner-price">
                                <span class="price">
                                    <strong>30%</strong> <br> off per kg
                                </span>
                            </div>
                        </div>
                    	<img src="front/assets/img/a.jpg" alt="">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
                    <h4>Hikan Strwaberry</h4>
                    <div class="text">Quisquam minus maiores repudiandae nobis, minima saepe id, fugit ullam similique! Beatae, minima quisquam molestias facere ea. Perspiciatis unde omnis iste natus error sit voluptatem accusant</div>
                    <!--Countdown Timer-->
                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2024/4/10"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
                	<a href="cart.html" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart banner section -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150" id="testimonial">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
                    @if(count(DB::table('testimomials')->get()->where('show','1')) == 0)
                        <div class=" font-weight-bold" style="font-size: 18px">{{ __('words.msgTestimonials') }}</div>
                    @elseif(count(DB::table('testimomials')->get()->where('show','1')) > 1)
                        <div class="testimonial-sliders">
                    @else
                        <div class="testimonial-sliderss">
                    @endif
                        @foreach (DB::table('testimomials')->get()->where('show','1') as $testimonial)
                            @foreach (DB::table('users')->where('id',$testimonial->userID)->get() as $user)
                                <div class="single-testimonial-slider">
                                    <div class="client-avater">
                                        <img src="{{ $user->profile_photo_path }}" alt="">
                                    </div>
                                    <div class="client-meta">
                                        <h3>{{ $user->name }} <span>Our Client</span></h3>
                                        @if (Session::get('lang') == 'ar')
                                            <p class="testimonial-body" dir="rtl">
                                                " {{ $testimonial->testimonialAr }} "
                                        @else
                                            <p class="testimonial-body">
                                                " {{ $testimonial->testimonialEn }} "
                                            @endif
                                        </p>
                                        <div class="last-icon">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
					</div>
				</div>
			</div>
            <div class=" text-center">
                <a href="{{ route('testimonial') }}" class="btn btn-l mt-5" style="background-color: #051922;color:#ffff">{{ __('words.addYourOpinion') }}</a>
            </div>
		</div>
	</div>
	<!-- end testimonail-section -->

	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
	<!-- end shop banner -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">
			<div class="row w-100">
				<div class="w-100 text-center">
					<div class="section-title">
						<h3>{{ __('words.ourNews') }}</h3>
						<p>{{ __('words.desOurNews') }}</p>
					</div>
				</div>
			</div>
			<div class="row">
                @foreach (DB::table('news')->whereNull('deleted_at')->where('status',1)->inRandomOrder()->take(3)->get() as $news)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="{{ route('news-read.show',$news->id) }}">
                                <img src="{{ $news->image }}" class="latest-news-bg w-100"/>
                            </a>
                            <div class="news-text-box">
                                <h3><a href="{{ route('news-read.show',$news->id) }}">{{ $news->title }}</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i> Admin</span>
                                    <span class="date"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)->format('d F, Y') }}</span>
                                </p>
                                <p class="excerpt">{!! strip_tags(html_entity_decode($news->body)) !!}</p>
                                <a href="{{ route('news-read.show',$news->id) }}" class="read-more-btn">{{ __('words.readmore') }} <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="{{ route('news-read.index') }}" class="boxed-btn">{{ __('words.moreNews') }}</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->
    {{ session()->forget('sucess') }}
@endsection
