@section('title')
    404!
@endsection


@extends('frontend.Layouts.master')


@section('content')
    <!-- end search arewa -->
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>404</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- error section -->
    <div class="full-height-section error-section">
        <div class="full-height-tablecell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="error-text">
                            <i class="far fa-sad-cry"></i>
                            <h1>{{ __('words.h1404') }}</h1>
                            <p>{{ __('words.p404') }}</p>
                            <a href="{{ route('homePage') }}" class="boxed-btn">{{ __('words.backToHome') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end error section -->
@endsection
