@section('title')
{{ __('words.editProduct') }}
@endsection
@extends("backend.Layouts.master")

@section('content')
    <div class="containers" >
        <div class="profile-setting">
            <form class="w-100 " method="POST" enctype="multipart/form-data" action="{{ route('prodecut.update',$product->id) }}">
                @csrf
                @method('put')
                <ul class="profile-edit-list row">
                    <li class="weight-500 col-md-6">
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.proNameEn') }}</label>
                            <input name="nameEn" class="form-control form-control-lg" type="text"
                            value="{{ $product->nameEn }}">
                            @if($errors->any('nameEn') && $errors->first('nameEn'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('nameEn') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.proDisEn') }}</label>
                            <textarea name="discriptionEn" class="form-control">{{ $product->descriptionEn }}</textarea>
                            @if($errors->any('discriptionEn') && $errors->first('discriptionEn'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('discriptionEn') }}</div>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.proColorEn') }}</label>
                            <input name="colorEn" class="form-control form-control-lg" type="text"
                            value="{{ $product->colorEn }}">
                        </div>
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.proQuantity') }}</label>
                            <input name="quantity" class="form-control form-control-lg" type="number"
                            min="0" value="{{ $product->quantity }}">
                            @if($errors->any('quantity') && $errors->first('quantity'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.proImage') }} </label>
                            <div class="alert alert-success mb-1">
                                {{ __('words.alertImage') }}
                            </div>
                            <input name="image" class="form-control form-control-lg " type="file">
                            @if($errors->any('image') && $errors->first('image'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </li>
                    <li class="weight-500 col-md-6" >
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.proNameAr') }}</label>
                            <input name="nameAr" class="form-control form-control-lg" type="text"
                            value="{{ $product->nameAr }}" dir="rtl">
                            @if($errors->any('nameAr') && $errors->first('nameAr'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('nameAr') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.proDisAr') }}</label>
                            <textarea name="discriptionAR" class="form-control" dir="rtl">{{ $product->descriptionAr }}</textarea>
                            @if($errors->any('discriptionAR') && $errors->first('discriptionAR'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('discriptionAR') }}</div>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.proColorAr') }}</label>
                            <input name="colorAr" class="form-control form-control-lg" type="text"
                            value="{{ $product->colorAr }}" dir="rtl">
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.category') }}</label>
                            <select class="custom-select" name="catID">
                                <option value=""  selected>{{ __('words.category') }}</option>
                                    @foreach (DB::table('categories')->where('parent',0)->whereNull('deleted_at')->get() as $cat)
                                        @if (Session::get('lang') == 'ar' )
                                            <option @if($product->categoryId == $cat->id) selected  @endif value="{{ $cat->id }}">{{ $cat->nameAr }}</option>
                                        @else
                                            <option @if($product->categoryId == $cat->id) selected  @endif value="{{ $cat->id }}">{{ $cat->nameEn }}</option>
                                        @endif
                                    @endforeach
                            </select>
                            @if($errors->any('catID') && $errors->first('catID'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('catID') }}</div>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label class=" font-weight-bold">{{ __('words.proPrice') }}</label>
                            <input name="price" class="form-control form-control-lg" type="text"
                            value="{{ $product->price }}">
                            @if($errors->any('price') && $errors->first('catpriceID'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                    </li>
                    <div class="form-group pt-4 text-center w-100 ">
                        <input type="submit" class="btn p-3 font-weight-bold w-25 bg-blue text-light" value="{{ __('words.editProduct') }}">
                    </div>
                </ul>
            </form>
        </div>
        {{ session()->forget('errors') }}
    </div>
@endsection

