@section('title')
    {{ __('words.editCat') }}
@endsection

@extends('backend.Layouts.master')
@section('content')
    <div class="containers">
        @if (Session::get('lang') == 'ar')
            <div class="profile-setting" dir="rtl">
            @elseif (Session::get('lang') == 'en')
                <div class="profile-setting" dir="ltr">
        @endif
        <form class="w-100 " method="post" enctype="multipart/form-data" action="{{ route('category.update', $cat->id) }}">
            @method('put')
            @csrf
            <ul class="profile-edit-list row">
                <li class="weight-500 col-md-6 ">
                    <div class="form-group">
                        <label class=" font-weight-bold">{{ __('words.catNameEn') }}</label>
                        <input name="nameEn" class="form-control form-control-lg" type="text" value="{{ $cat->nameEn }}">
                        @if($errors->any('nameEn') && $errors->first('nameEn'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('nameEn') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" font-weight-bold">{{ __('words.catDisEn') }}</label>
                        <textarea name="discriptionEn" class="form-control">{{ $cat->discriptionEn }}</textarea>
                        @if($errors->any('discriptionEn') && $errors->first('discriptionEn'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('discriptionEn') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" font-weight-bold">{{ __('words.catImageEdit') }}</label>
                        <div class="alert alert-success mb-1">
                                {{ __('words.alertImage') }}
                        </div>
                        <input name="image" class="form-control form-control-lg" type="file">
                        @if($errors->any('image') && $errors->first('image'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                </li>
                <li class="weight-500 col-md-6 ">
                    <div class="form-group">
                        <label class=" font-weight-bold">{{ __('words.catNameAr') }}</label>
                        <input name="nameAr" class="form-control form-control-lg" type="text"
                            value="{{ trim($cat->nameAr) }}" dir="rtl">
                        @if($errors->any('nameAr') && $errors->first('nameAr'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('nameAr') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" font-weight-bold">{{ __('words.catDisAr') }}</label>
                        <textarea name="discriptionAr" class="form-control" dir="rtl">{{ $cat->discriptionAr }}</textarea>
                        @if($errors->any('discriptionAr') && $errors->first('discriptionAr'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('discriptionAr') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" font-weight-bold">{{ __('words.catType') }}</label>
                        <select class="custom-select" name="parent">
                            <option value="" disabled selected>{{ __('words.catType') }}</option>
                            <option value="0" class=" font-weight-bold">{{ __('words.catMain') }}</option>
                            <optgroup label="{{ __('words.catSubsection') }}">
                                @foreach (DB::table('categories')->where('parent', 0)->whereNull('deleted_at')->get() as $c)
                                    @foreach (DB::table('categories')->get()->where('id', $cat->id) as $cats)
                                        @if (Session::get('lang') == 'ar')
                                            <option @if ($c->id == $cats->parent) selected @endif
                                                value="{{ $c->id }}">{{ $c->nameAr }} </option>
                                        @else
                                            <option @if ($c->id == $cats->parent) selected @endif
                                                value="{{ $c->id }}">{{ $c->nameEn }} </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </optgroup>
                        </select>
                        @if($errors->any('parent') && $errors->first('parent'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('parent') }}</div>
                        @endif
                    </div>
                </li>
                <div class="form-group pt-4 text-center w-100">
                    <input type="submit" class="btn p-3 font-weight-bold w-25 bg-blue text-light"
                        value="{{ __('words.editCat') }}">
                </div>
            </ul>
        </form>
    </div>
    {{ session()->forget('errors') }}
@endsection
