@section('title')
{{ __('words.changePassword') }}
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
                    timer: 1500,
                });
            @endif
            {{ session()->forget('sucess') }}
        </script>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-12">
                    <div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center">{{ __('words.changePassword') }}</h2>
						</div>
                        @if(!is_null(session('erorr')))
                            <div class="alert alert-danger">{{ session('erorr') }}</div>
                        @endif
						<form action="{{ route('changePass') }}" method="POST">
                            @csrf
                            @method('post')
                            <input name="id" type="hidden" value="{{ $data }}">
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg"
                                placeholder="{{ __('words.password') }}" value="{{ old('password') }}">
							</div>
                            @if($errors->any('password') && $errors->first('password'))
                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                            @endif
							<div class="input-group custom">
								<input type="password" name="Cpassword" class="form-control form-control-lg"
                                placeholder="{{ __('words.cPassword') }}" value="{{ old('Cpassword') }}">
							</div>
                            @if($errors->any('Cpassword') && $errors->first('Cpassword'))
                                <div class="alert alert-danger">{{ $errors->first('Cpassword') }}</div>
                            @endif
							<div class="row">
								<div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-dark btn-sm btn-block youssef"
                                        style=" background-color: #ff735c !important; color: white !important;border-color:  #ff735c !important;"
                                        type="submit" value="{{ __('words.save') }}">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        {{ session()->forget('erorr') }}
	</div>
</body>
@endsection
