@section('title')
{{ __('words.editShiping') }}
@endsection
@extends("backend.Layouts.master")

@section('content')
    <div class="containers" >
        <div class="profile-setting">
            <form class="w-100 d-flex justify-content-center" method="POST" action="{{ route('shipping.update') }}">
                @csrf
                @method('put')
                <ul class="profile-edit-list row">
                    <li class="weight-500 col-md-12 w-50">
                        <input name="id" type="hidden" value="{{ $shiping->id }}">
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.areaNameEn') }}</label>
                            <input name="nameEn" class="form-control form-control-lg" type="text"
                            value="{{ $shiping->areaEn }}">
                            @if($errors->any('nameEn') && $errors->first('nameEn'))
                                <div class="alert alert-danger">{{ $errors->first('nameEn') }}</div>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.areaNameAr') }}</label>
                            <input name="nameAr" class="form-control form-control-lg" type="text"
                            value="{{ $shiping->areaAr }}" dir="rtl">
                            @if($errors->any('nameAr') && $errors->first('nameAr'))
                                <div class="alert alert-danger">{{ $errors->first('nameAr') }}</div>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.areaValue') }}</label>
                            <input name="value" class="form-control form-control-lg" type="text"
                            value="{{ $shiping->value }}">
                            @if($errors->any('value') && $errors->first('value'))
                                <div class="alert alert-danger">{{ $errors->first('value') }}</div>
                            @endif
                        </div>
                    </li>
                    <div class="form-group pt-4 text-center w-100 ">
                        <input type="submit" class="btn p-3 font-weight-bold w-25 bg-blue text-light" value="{{ __('words.editShiping') }}">
                    </div>
                </ul>
            </form>
        </div>
    </div>
    {{ session()->forget('errors') }}
@endsection
