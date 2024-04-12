@section('title')
{{ __('words.addCat') }}
@endsection
@extends("backend.Layouts.master")

@section('content')
    <div class="containers" >
        @if (Session::get('lang') == 'ar' )
            <div class="profile-setting" dir="rtl">
        @elseif (Session::get('lang') == 'en')
            <div class="profile-setting" dir="ltr">
        @endif
            <form class="w-100 " method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}">
                @csrf
                <ul class="profile-edit-list row">
                    <li class="weight-500 col-md-6">
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.catNameEn') }}</label>
                            <input name="nameEn" class="form-control form-control-lg" type="text"
                            value="{{ old('nameEn') }}">
                            @if($errors->any('nameEn') && $errors->first('nameEn'))
                                <div class="alert alert-danger">{{ $errors->first('nameEn') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.catDisEn') }}</label>
                            <textarea name="discriptionEn" class="form-control">{{ old('discriptionEn') }}</textarea>
                            @if($errors->any('discriptionEn') && $errors->first('discriptionEn'))
                                <div class="alert alert-danger">{{ $errors->first('discriptionEn') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.catImage') }}</label>
                            <input name="image" class="form-control form-control-lg " type="file">
                            @if($errors->any('image') && $errors->first('image'))
                                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </li>
                    <li class="weight-500 col-md-6" >
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.catNameAr') }}</label>
                            <input name="nameAr" class="form-control form-control-lg" type="text"
                            value="{{ old('nameAr') }}" dir="rtl">
                            @if($errors->any('nameAr') && $errors->first('nameAr'))
                                <div class="alert alert-danger">{{ $errors->first('nameAr') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.catDisAr') }}</label>
                            <textarea name="discriptionAR" class="form-control" dir="rtl">{{(old('discriptionAr'))}}</textarea>
                            @if($errors->any('discriptionAR') && $errors->first('discriptionAR'))
                                <div class="alert alert-danger">{{ $errors->first('discriptionAR') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.catType') }}</label>
                            <select class="custom-select" name="parent">
                                <option value="" selected>{{ __('words.catType') }}</option>
                                <option value="0" class=" font-weight-bold">{{ __('words.catMain') }}</option>
                                <optgroup label="{{ __('words.catSubsection') }}">
                                    @foreach (DB::table('categories')->where('parent',0)->whereNull('deleted_at')->get() as $cat)
                                        @if (Session::get('lang') == 'ar' )
                                            <option value="{{ $cat->id }}">{{ $cat->nameAr }}</option>
                                        @else
                                            <option value="{{ $cat->id }}">{{ $cat->nameEn }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            @if($errors->any('parent') && $errors->first('parent'))
                                <div class="alert alert-danger">{{ $errors->first('parent') }}</div>
                            @endif
                            {{-- <textarea name="discriptionAr" class="form-control">{{(old('discriptionAr'))}}</textarea> --}}
                        </div>
                    </li>
                    <div class="form-group pt-4 text-center w-100 ">
                        <input type="submit" class="btn p-3 font-weight-bold w-25 bg-blue text-light" value="{{ __('words.addCat') }}">
                    </div>
                </ul>
            </form>
        </div>
    </div>
    {{ session()->forget('errors') }}
@endsection
