@section('title')
{{ __('words.login') }}
@endsection
@extends('Auth.master')


@section('content')
<body class="login-page bg-white">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        @if (session()->get('loginError'))
            <div class=" text-center alert alert-danger">
                {{ session()->get('loginError') }}
            </div>
        @endif
        <div class="container">
            <div class="row align-items-center">
				<div class="col-md-6 col-lg-12">
                    <div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center">{{ __('words.welcomeBack') }}</h2>
							<p class="text-center">
                                <span style="font-size: 12px">{{ __('words.registerNow') }}</span>
                                <a
                                style=" color: black !important;font-weight:bold !important; font-size:12px"
                                href="{{ route('admin.register') }}">{{ __('words.signUpNow') }}</a></p>
						</div>
						<form action="{{ route('admin.login.post') }}" method="POST">
                            @csrf
                            @method('post')
							<div class="input-group custom">
								<input type="text" name="username" class="form-control form-control-lg"
                                placeholder="{{ __('words.username') }}" value="{{ old('username') }}">
								<div class="input-group-append custom">
									<span class="input-group-text bg-black"><i class="fas fa-user-shield"></i></span>
								</div>
							</div>
                            @if($errors->any('username') && $errors->first('username'))
                                <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                            @endif
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg"
                                placeholder="**********" value="{{ old('password') }}">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fas fa-lock"></i></span>
								</div>
							</div>
                            @if($errors->any('password') && $errors->first('password'))
                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                            @endif
							<div class="row pb-30">
								<div class="col-12">
									<div class="forgot-password"><a href="{{ route('admin.forgot') }}">{{ __('words.forgotPassword') }}</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-dark btn-sm btn-block youssef"
                                        style=" background-color: #ff735c !important; color: white !important;border-color:  #ff735c !important;"
                                        type="submit" value="{{ __('words.signIn') }}">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    {{ session()->forget('errors') }}
    {{ session()->forget('loginError') }}
</body>
@endsection
