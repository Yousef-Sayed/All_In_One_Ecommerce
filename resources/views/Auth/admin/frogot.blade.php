@section('title')
{{ __('words.resetPassword') }}
@endsection
@extends('Auth.master')

@section('content')
<body class="login-page bg-white">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <script>
            @if (!is_null(session('sucess')))
                Swal.fire({
                    position: "center-center",
                    icon: "success",
                    title: "{{ session('sucess') }}",
                    showConfirmButton: false,
                    timer: 3000,
                });
            @endif
            {{ session()->forget('sucess') }}
        </script>
        <div class="container">
            <div class="row align-items-center">
				<div class="col-md-6 col-lg-12">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center">{{ __('words.resetPassword') }}</h2>
						</div>
						<form action="{{ route('admin.forgot.password') }}" method="POST">
                            @csrf
                            @method('post')
							<div class="input-group custom">
								<input type="text" name="email" class="form-control form-control-lg"
                                placeholder="{{ __('words.email') }}" value="{{ old('email') }}">
								<div class="input-group-append custom">
									<span class="input-group-text bg-black"><i class="far fa-envelope"></i></span>
								</div>
							</div>
                            @if(!is_null(session('erorr')))
                                <div class="alert alert-danger">{{ session('erorr') }}</div>
                            @endif
                            {{ session()->forget('erorr') }}
							<div class="row">
								<div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-dark btn-sm btn-block youssef"
                                        style=" background-color: #ff735c !important; color: white !important;border-color:  #ff735c !important;"
                                        type="submit" value="{{ __('words.sendMessage') }}">
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
</body>
@endsection
