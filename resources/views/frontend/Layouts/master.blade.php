<!DOCTYPE html>
<html lang="{{ Session::get('lang') }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Ecommerce Project">

	<!-- title -->
	<title>@yield('title')</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <script src="{{ asset('backend/sweetalert2@11.js') }}"></script>
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/all.min.css') }}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('front/assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">

</head>
@if (Session::get('lang') == 'ar' )
    <body style="direction: rtl !important">
@else
    <body style="direction: ltr !important">
@endif
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>

    <!--PreLoader Ends-->
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
                        <div class="site-logo">
                            <a href="{{ route('homePage') }}">
                                <svg width="120" height="40" viewBox="0 0 370 69.99825100500458" class="looka-1j8o68f"><defs id="SvgjsDefs2462"></defs><g id="SvgjsG2463" featurekey="JKiIdh-0" transform="matrix(0.8749781375625572,0,0,0.8749781375625572,-8.749781375625572,-8.749781375625572)" fill="#ffffff"><polygon xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="61.669,90   18.333,90 14,64.001 65.999,64.001 "></polygon><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M23.999,86.412  c-0.778,0-1.411-0.632-1.411-1.411V69c0-0.78,0.632-1.41,1.411-1.41c0.78,0,1.411,0.63,1.411,1.41v16.001  C25.41,85.78,24.779,86.412,23.999,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M32,86.412  c-0.78,0-1.413-0.632-1.413-1.411V69c0-0.78,0.632-1.41,1.413-1.41c0.779,0,1.411,0.63,1.411,1.41v16.001  C33.412,85.78,32.779,86.412,32,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M40,86.412  c-0.78,0-1.413-0.632-1.413-1.411V69c0-0.78,0.632-1.41,1.413-1.41c0.778,0,1.409,0.63,1.409,1.41v16.001  C41.409,85.78,40.779,86.412,40,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M48,86.412  c-0.78,0-1.411-0.632-1.411-1.411V69c0-0.78,0.63-1.41,1.411-1.41s1.411,0.63,1.411,1.41v16.001  C49.411,85.78,48.78,86.412,48,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M56.002,86.412  c-0.782,0-1.413-0.632-1.413-1.411V69c0-0.78,0.631-1.41,1.413-1.41c0.778,0,1.408,0.63,1.408,1.41v16.001  C57.41,85.78,56.78,86.412,56.002,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M46.196,40.756  l-3.696,1.53l7.648,18.466c0.002,0.004,0.003,0.009,0.005,0.015c0.422,1.02,1.594,1.504,2.613,1.081  c1.023-0.424,1.506-1.593,1.082-2.613l0.003-0.001l0,0L46.196,40.756z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M37.502,42.288  l-3.697-1.532l-7.648,18.466c-0.002,0.004-0.003,0.007-0.007,0.012c-0.422,1.021,0.062,2.189,1.083,2.613s2.191-0.062,2.613-1.081  l0,0l0,0L37.502,42.288z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M68.001,56.002  H52.512l1.34,3.231l-0.003,0.001c0.424,1.021-0.059,2.189-1.082,2.613c-1.02,0.423-2.191-0.062-2.613-1.081  c-0.002-0.006-0.003-0.011-0.005-0.015l-1.967-4.75h-16.36l-1.974,4.765l0,0c-0.422,1.02-1.591,1.505-2.613,1.081  s-1.506-1.592-1.083-2.613c0.003-0.005,0.005-0.008,0.007-0.012l1.335-3.221H12c-1.101,0-2,0.898-2,1.998v4  c0,1.102,0.899,2.001,2,2.001h56.001c1.1,0,2.002-0.899,2.002-2.001v-4C70.003,56.9,69.101,56.002,68.001,56.002z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M74.646,60.063  c-0.854,0-1.55-0.692-1.55-1.545V40.97c0-0.854,0.695-1.547,1.55-1.547s1.551,0.692,1.551,1.547v17.548  C76.197,59.371,75.501,60.063,74.646,60.063z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M63.897,10  l-4.051,1.678l8.385,20.253c0.004,0.003,0.004,0.007,0.004,0.014c0.462,1.12,1.743,1.648,2.866,1.183  c1.12-0.461,1.65-1.745,1.188-2.864h0.004l0,0L63.897,10z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M54.365,11.679  L50.31,10l-8.389,20.249c0,0.007-0.001,0.012-0.005,0.014c-0.465,1.12,0.067,2.403,1.188,2.866c1.12,0.463,2.401-0.065,2.863-1.187  V31.94l0,0L54.365,11.679z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M87.808,26.716  H70.819l1.475,3.547H72.29c0.462,1.12-0.068,2.403-1.188,2.864c-1.123,0.465-2.404-0.063-2.866-1.183c0-0.007,0-0.01-0.004-0.014  l-2.163-5.214H48.133l-2.166,5.225v0.001c-0.461,1.122-1.743,1.65-2.863,1.187c-1.122-0.463-1.654-1.747-1.188-2.866  c0.003-0.002,0.005-0.007,0.005-0.014l1.466-3.533h-16.99c-1.208,0-2.194,0.987-2.194,2.193v4.389c0,1.206,0.987,2.191,2.194,2.191  h61.411c1.209,0,2.194-0.985,2.194-2.191v-4.389C90.002,27.703,89.017,26.716,87.808,26.716z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M28.59,35.489  l2.124,12.737l3.092-7.469l3.695,1.532l-5.545,13.39l0.053,0.324h16.172L42.5,42.286l3.696-1.53l6.315,15.246h15.489  c1.1,0,2.002,0.898,2.002,1.998v4c0,1.099-0.896,1.994-1.991,2h12.851l4.751-28.511H28.59z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M67.426,56.002V40.97  c0-0.854-0.696-1.547-1.551-1.547c-0.854,0-1.55,0.692-1.55,1.547v15.032H67.426z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M58.647,56.002V40.97  c0-0.854-0.692-1.547-1.544-1.547c-0.857,0-1.547,0.692-1.547,1.547v15.032H58.647z"></path></g><g id="SvgjsG2464" featurekey="A7DQL5-0" transform="matrix(3.206596438142185,0,0,3.206596438142185,90,-3.5959681637911842)" fill="#ffffff"><path d="M5.34 6.140000000000001 c0 0.08 0.23666 0.84334 0.71 2.29 s0.99 3.03 1.55 4.75 s1.3133 3.9934 2.26 6.82 l0.86 0 l-5.3 -15.76 l-0.16 0 l-5.26 15.76 l0.82 0 z M4.98 15.52 l-0.72 0 l1.2 4.48 l0.72 0 z M13.98 16.06 l0 -11.82 l-0.66 0 l0 11.82 l0.66 0 z M19.36 20 l0 -0.68 l-5.38 0 l0 -1.96 l-0.66 0 l0 2.64 l6.04 0 z M22.62 16.06 l0 -11.82 l-0.66 0 l0 11.82 l0.66 0 z M28 20 l0 -0.68 l-5.38 0 l0 -1.96 l-0.66 0 l0 2.64 l6.04 0 z M35.6 4.24 l0 15.76 l0.52 0 l0 -15.76 l-0.52 0 z M45.7 4.58 l-0.000019531 11.56 c0 0.36 0.0066602 0.76 0.02 1.2 s0.02 0.66666 0.02 0.68 c-0.02666 -0.04 -0.12332 -0.25666 -0.28998 -0.65 s-0.33 -0.74334 -0.49 -1.05 l-0.28 -0.54 l-0.72 0 l2.2 4.22 l0.18 0 l0 -15.42 l-0.64 0 z M40.08 7.9399999999999995 l0.27998 0.54 l0.72 0 l-2.22 -4.24 l-0.14 0 l0 15.46 l0.62 0 l0 -11.6 c0 -0.33334 -0.0066602 -0.72334 -0.02 -1.17 s-0.02 -0.67666 -0.02 -0.69 c0.01334 0.04 0.10668 0.26 0.28002 0.66 s0.34 0.74666 0.5 1.04 z M60.94 20 c2.2134 0 4.1 -0.78 5.66 -2.34 c0.77334 -0.76 1.3567 -1.58 1.75 -2.46 s0.59 -1.88 0.59 -3 c0 -2.2266 -0.78 -4.1066 -2.34 -5.64 c-1.56 -1.52 -3.4866 -2.2866 -5.78 -2.3 c-1.4133 0.01334 -2.74 0.36668 -3.98 1.06 c-1.2133 0.70666 -2.18 1.6867 -2.9 2.94 l0.58 0.32 c0.65334 -1.16 1.54 -2.06 2.66 -2.7 c1.1067 -0.64 2.32 -0.96666 3.64 -0.98 c2.1334 0.01334 3.9066 0.72668 5.32 2.14 c1.4133 1.3867 2.1266 3.1066 2.14 5.16 c0 1.0267 -0.18 1.9433 -0.54 2.75 s-0.88666 1.5633 -1.58 2.27 c-1.4267 1.4267 -3.1666 2.14 -5.22 2.14 c-1.28 0 -2.44 -0.27334 -3.48 -0.82 l-0.3 0.58 c1.1333 0.58666 2.3934 0.88 3.78 0.88 z M78.52 4.58 l-0.000019531 11.56 c0 0.36 0.0066602 0.76 0.02 1.2 s0.02 0.66666 0.02 0.68 c-0.02666 -0.04 -0.12332 -0.25666 -0.28998 -0.65 s-0.33 -0.74334 -0.49 -1.05 l-0.28 -0.54 l-0.72 0 l2.2 4.22 l0.18 0 l0 -15.42 l-0.64 0 z M72.89999999999999 7.9399999999999995 l0.27998 0.54 l0.72 0 l-2.22 -4.24 l-0.14 0 l0 15.46 l0.62 0 l0 -11.6 c0 -0.33334 -0.0066602 -0.72334 -0.02 -1.17 s-0.02 -0.67666 -0.02 -0.69 c0.01334 0.04 0.10668 0.26 0.28002 0.66 s0.34 0.74666 0.5 1.04 z M82.32 14.16 l0 -9.36 l4.8 0 l0 -0.56 l-5.36 0 l0 9.92 l0.56 0 z M87.32 20 l0 -0.54 l-5 0 l0 -4.14 l0.8 0 l0 -0.54 l-1.36 0 l0 5.22 l5.56 0 z"></path></g></svg>
                            </a>
                        </div>
						<!-- menu start -->
						<nav class="main-menu">
							<ul class="align-items-center">
								<li class="current-list-item"><a href="{{ route('homePage') }}">{{ __('words.home') }}</a>
								</li>
								<li><a href="{{ route('showAllPro') }}"> {{ __('words.products') }}</a></li>
								<li>
                                    <a href="{{ route('homePage') }}#category">{{ __('words.categories') }}</a>
                                    <ul class="sub-menu">
                                        @foreach (DB::table('categories')->get()->where('parent','0')->whereNull('deleted_at') as $cat)
                                                <li><a href="{{ route('show.category',$cat->id) }}">
                                                    @if (Session::get('lang') == 'en')
                                                        {{ $cat->nameEn }}
                                                    @elseif (Session::get('lang') == 'ar')
                                                        {{ $cat->nameAr }}
                                                    @else
                                                        {{ $cat->nameEn }}
                                                    @endif
                                                </a></li>
                                        @endforeach

                                    </ul>
                                </li>
								<li><a href="{{ route('homePage') }}#testimonial">{{ __('words.testimonials') }}</a></li>
								<li><a href="{{ route('news-read.index') }}">{{ __('words.news') }}</a></li>
                                <li>
                                    <a href="#" style="pointer-events: none; cursor= default;">{{ __('words.lang') }} <i class="fas fa-globe"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('langg','ar') }}">العربيه</a></li>
                                        <li><a href="{{ route('langg','en') }}">English</a></li>
                                    </ul>
                                <li class="d-lg-flex m-lg-1 align-items-center">
									<div class="d-flex align-items-center">
                                        <a class="shopping-cart pt-3" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i>  @if( session()->has('cart'))  {{ count(session()->get('cart')) }} @endif </a>
										<a class="mobile-hide search-bar-icon"><i class="fas fa-search"></i></a>
									</div>
                                    <div>
                                        <ul>
                                            <li class="lo">
                                                @if (is_null(Auth::user()))
                                                    <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                                                @else
                                                    <a href="{{ route('login') }}" style="pointer-events: none; cursor= default;"> <span
                                                        style="
                                                                background-color: white;
                                                                width: 30px;
                                                                height: 30px;
                                                                border-radius: 50%;
                                                                color: #051922;
                                                                padding: 5px;
                                                            ">
                                                            @php
                                                            $words = explode(" ", Auth::user()->name);
                                                            $acronym = "";

                                                            foreach ($words as $w) {
                                                                $acronym .= mb_substr($w, 0, 1);
                                                            }
                                                            @endphp

                                                            {{ $acronym }}
                                                        </span>
                                                    </a>
                                                    <ul class="sub-men">
                                                        @if (Auth::user()->social_type == 'system')
                                                            <li><a href="{{ route('profileUser') }}">{{ __('words.profile')}}</a></li>
                                                        @endif
                                                        <li><a href="{{ route('logout') }}">{{ __('words.signOut') }}</a></li>
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<form class="search-bar-tablecell" action="{{ route('show') }}" method="GET">
                            <h3>{{ __('words.searchTitle') }}</h3>
							<input type="text" name="search" placeholder="{{ __('words.searchPalceholder') }}">
							<button type="submit">{{ __('words.searchButton') }} <i class="fas fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->
    @yield('content')

    <!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">{{ __('words.aboutUs') }}</h2>
						<p>{{ __('words.PaboutUs') }}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">{{ __('words.getInTocuh') }}</h2>
						<ul>
							<li>{{ __('words.PgetInTocuh') }}</li>
							<li>sayedyousef775@gmail.com</li>
							<li>+20 1122 9173 97</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">{{ __('words.pages') }}</h2>
						<ul>
							<li class="current-list-item"><a href="{{ route('homePage') }}">{{ __('words.home') }}</a></li>
                            <li><a href="{{ route('showAllPro') }}"> {{ __('words.products') }}</a></li>
                            <li><a href="{{ route('homePage') }}#category">{{ __('words.categories') }}</a>
                            <li><a href="{{ route('homePage') }}#testimonial">{{ __('words.testimonials') }}</a>
                            <li><a href="{{ route('news-read.index') }}">{{ __('words.news') }}</a>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 d-flex align-items-center justify-content-center">
                    <a href="{{ route('homePage') }}">
                        <svg width="300" height="40" viewBox="0 0 370 69.99825100500458" class="looka-1j8o68f"><defs id="SvgjsDefs2462"></defs><g id="SvgjsG2463" featurekey="JKiIdh-0" transform="matrix(0.8749781375625572,0,0,0.8749781375625572,-8.749781375625572,-8.749781375625572)" fill="#ffffff"><polygon xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="61.669,90   18.333,90 14,64.001 65.999,64.001 "></polygon><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M23.999,86.412  c-0.778,0-1.411-0.632-1.411-1.411V69c0-0.78,0.632-1.41,1.411-1.41c0.78,0,1.411,0.63,1.411,1.41v16.001  C25.41,85.78,24.779,86.412,23.999,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M32,86.412  c-0.78,0-1.413-0.632-1.413-1.411V69c0-0.78,0.632-1.41,1.413-1.41c0.779,0,1.411,0.63,1.411,1.41v16.001  C33.412,85.78,32.779,86.412,32,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M40,86.412  c-0.78,0-1.413-0.632-1.413-1.411V69c0-0.78,0.632-1.41,1.413-1.41c0.778,0,1.409,0.63,1.409,1.41v16.001  C41.409,85.78,40.779,86.412,40,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M48,86.412  c-0.78,0-1.411-0.632-1.411-1.411V69c0-0.78,0.63-1.41,1.411-1.41s1.411,0.63,1.411,1.41v16.001  C49.411,85.78,48.78,86.412,48,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M56.002,86.412  c-0.782,0-1.413-0.632-1.413-1.411V69c0-0.78,0.631-1.41,1.413-1.41c0.778,0,1.408,0.63,1.408,1.41v16.001  C57.41,85.78,56.78,86.412,56.002,86.412z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M46.196,40.756  l-3.696,1.53l7.648,18.466c0.002,0.004,0.003,0.009,0.005,0.015c0.422,1.02,1.594,1.504,2.613,1.081  c1.023-0.424,1.506-1.593,1.082-2.613l0.003-0.001l0,0L46.196,40.756z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M37.502,42.288  l-3.697-1.532l-7.648,18.466c-0.002,0.004-0.003,0.007-0.007,0.012c-0.422,1.021,0.062,2.189,1.083,2.613s2.191-0.062,2.613-1.081  l0,0l0,0L37.502,42.288z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M68.001,56.002  H52.512l1.34,3.231l-0.003,0.001c0.424,1.021-0.059,2.189-1.082,2.613c-1.02,0.423-2.191-0.062-2.613-1.081  c-0.002-0.006-0.003-0.011-0.005-0.015l-1.967-4.75h-16.36l-1.974,4.765l0,0c-0.422,1.02-1.591,1.505-2.613,1.081  s-1.506-1.592-1.083-2.613c0.003-0.005,0.005-0.008,0.007-0.012l1.335-3.221H12c-1.101,0-2,0.898-2,1.998v4  c0,1.102,0.899,2.001,2,2.001h56.001c1.1,0,2.002-0.899,2.002-2.001v-4C70.003,56.9,69.101,56.002,68.001,56.002z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M74.646,60.063  c-0.854,0-1.55-0.692-1.55-1.545V40.97c0-0.854,0.695-1.547,1.55-1.547s1.551,0.692,1.551,1.547v17.548  C76.197,59.371,75.501,60.063,74.646,60.063z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M63.897,10  l-4.051,1.678l8.385,20.253c0.004,0.003,0.004,0.007,0.004,0.014c0.462,1.12,1.743,1.648,2.866,1.183  c1.12-0.461,1.65-1.745,1.188-2.864h0.004l0,0L63.897,10z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M54.365,11.679  L50.31,10l-8.389,20.249c0,0.007-0.001,0.012-0.005,0.014c-0.465,1.12,0.067,2.403,1.188,2.866c1.12,0.463,2.401-0.065,2.863-1.187  V31.94l0,0L54.365,11.679z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M87.808,26.716  H70.819l1.475,3.547H72.29c0.462,1.12-0.068,2.403-1.188,2.864c-1.123,0.465-2.404-0.063-2.866-1.183c0-0.007,0-0.01-0.004-0.014  l-2.163-5.214H48.133l-2.166,5.225v0.001c-0.461,1.122-1.743,1.65-2.863,1.187c-1.122-0.463-1.654-1.747-1.188-2.866  c0.003-0.002,0.005-0.007,0.005-0.014l1.466-3.533h-16.99c-1.208,0-2.194,0.987-2.194,2.193v4.389c0,1.206,0.987,2.191,2.194,2.191  h61.411c1.209,0,2.194-0.985,2.194-2.191v-4.389C90.002,27.703,89.017,26.716,87.808,26.716z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M28.59,35.489  l2.124,12.737l3.092-7.469l3.695,1.532l-5.545,13.39l0.053,0.324h16.172L42.5,42.286l3.696-1.53l6.315,15.246h15.489  c1.1,0,2.002,0.898,2.002,1.998v4c0,1.099-0.896,1.994-1.991,2h12.851l4.751-28.511H28.59z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M67.426,56.002V40.97  c0-0.854-0.696-1.547-1.551-1.547c-0.854,0-1.55,0.692-1.55,1.547v15.032H67.426z"></path><path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M58.647,56.002V40.97  c0-0.854-0.692-1.547-1.544-1.547c-0.857,0-1.547,0.692-1.547,1.547v15.032H58.647z"></path></g><g id="SvgjsG2464" featurekey="A7DQL5-0" transform="matrix(3.206596438142185,0,0,3.206596438142185,90,-3.5959681637911842)" fill="#ffffff"><path d="M5.34 6.140000000000001 c0 0.08 0.23666 0.84334 0.71 2.29 s0.99 3.03 1.55 4.75 s1.3133 3.9934 2.26 6.82 l0.86 0 l-5.3 -15.76 l-0.16 0 l-5.26 15.76 l0.82 0 z M4.98 15.52 l-0.72 0 l1.2 4.48 l0.72 0 z M13.98 16.06 l0 -11.82 l-0.66 0 l0 11.82 l0.66 0 z M19.36 20 l0 -0.68 l-5.38 0 l0 -1.96 l-0.66 0 l0 2.64 l6.04 0 z M22.62 16.06 l0 -11.82 l-0.66 0 l0 11.82 l0.66 0 z M28 20 l0 -0.68 l-5.38 0 l0 -1.96 l-0.66 0 l0 2.64 l6.04 0 z M35.6 4.24 l0 15.76 l0.52 0 l0 -15.76 l-0.52 0 z M45.7 4.58 l-0.000019531 11.56 c0 0.36 0.0066602 0.76 0.02 1.2 s0.02 0.66666 0.02 0.68 c-0.02666 -0.04 -0.12332 -0.25666 -0.28998 -0.65 s-0.33 -0.74334 -0.49 -1.05 l-0.28 -0.54 l-0.72 0 l2.2 4.22 l0.18 0 l0 -15.42 l-0.64 0 z M40.08 7.9399999999999995 l0.27998 0.54 l0.72 0 l-2.22 -4.24 l-0.14 0 l0 15.46 l0.62 0 l0 -11.6 c0 -0.33334 -0.0066602 -0.72334 -0.02 -1.17 s-0.02 -0.67666 -0.02 -0.69 c0.01334 0.04 0.10668 0.26 0.28002 0.66 s0.34 0.74666 0.5 1.04 z M60.94 20 c2.2134 0 4.1 -0.78 5.66 -2.34 c0.77334 -0.76 1.3567 -1.58 1.75 -2.46 s0.59 -1.88 0.59 -3 c0 -2.2266 -0.78 -4.1066 -2.34 -5.64 c-1.56 -1.52 -3.4866 -2.2866 -5.78 -2.3 c-1.4133 0.01334 -2.74 0.36668 -3.98 1.06 c-1.2133 0.70666 -2.18 1.6867 -2.9 2.94 l0.58 0.32 c0.65334 -1.16 1.54 -2.06 2.66 -2.7 c1.1067 -0.64 2.32 -0.96666 3.64 -0.98 c2.1334 0.01334 3.9066 0.72668 5.32 2.14 c1.4133 1.3867 2.1266 3.1066 2.14 5.16 c0 1.0267 -0.18 1.9433 -0.54 2.75 s-0.88666 1.5633 -1.58 2.27 c-1.4267 1.4267 -3.1666 2.14 -5.22 2.14 c-1.28 0 -2.44 -0.27334 -3.48 -0.82 l-0.3 0.58 c1.1333 0.58666 2.3934 0.88 3.78 0.88 z M78.52 4.58 l-0.000019531 11.56 c0 0.36 0.0066602 0.76 0.02 1.2 s0.02 0.66666 0.02 0.68 c-0.02666 -0.04 -0.12332 -0.25666 -0.28998 -0.65 s-0.33 -0.74334 -0.49 -1.05 l-0.28 -0.54 l-0.72 0 l2.2 4.22 l0.18 0 l0 -15.42 l-0.64 0 z M72.89999999999999 7.9399999999999995 l0.27998 0.54 l0.72 0 l-2.22 -4.24 l-0.14 0 l0 15.46 l0.62 0 l0 -11.6 c0 -0.33334 -0.0066602 -0.72334 -0.02 -1.17 s-0.02 -0.67666 -0.02 -0.69 c0.01334 0.04 0.10668 0.26 0.28002 0.66 s0.34 0.74666 0.5 1.04 z M82.32 14.16 l0 -9.36 l4.8 0 l0 -0.56 l-5.36 0 l0 9.92 l0.56 0 z M87.32 20 l0 -0.54 l-5 0 l0 -4.14 l0.8 0 l0 -0.54 l-1.36 0 l0 5.22 l5.56 0 z"></path></g></svg>
                    </a>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>{{ __('words.copyrights') }}</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="https://www.facebook.com/yousef.sayed.98434" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://wa.me/201018169667" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
							<li><a href="https://www.linkedin.com/in/youssef-sayed-4b290722a" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="{{ asset('front/assets/js/jquery-1.11.3.min.js') }}"></script>
	<!-- bootstrap -->
	<script src="{{ asset('front/assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- count down -->
	<script src="{{ asset('front/assets/js/jquery.countdown.js') }}"></script>
	<!-- isotope -->
	<script src="{{ asset('front/assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
	<!-- waypoints -->
	<script src="{{ asset('front/assets/js/waypoints.js') }}"></script>
	<!-- owl carousel -->
	<script src="{{ asset('front/assets/js/owl.carousel.min.js') }}"></script>
	<!-- magnific popup -->
	<script src="{{ asset('front/assets/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- mean menu -->
	<script src="{{ asset('front/assets/js/jquery.meanmenu.min.js') }}"></script>
	<!-- sticker js -->
	<script src="{{ asset('front/assets/js/sticker.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
	<!-- main js -->
	<script src="{{ asset('front/assets/js/main.js') }}"></script>

</body>
</html>
