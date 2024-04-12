@section('title')
{{ __('words.editNews') }}
@endsection
@extends("backend.Layouts.master")

@section('content')
    <div class="containers" >
        @if (Session::get('lang') == 'ar' )
            <div class="profile-setting" dir="rtl">
        @elseif (Session::get('lang') == 'en')
            <div class="profile-setting" dir="ltr">
        @endif
            <form class="w-100" method="POST" enctype="multipart/form-data" action="{{ route('news.update',$news->id) }}">
                @csrf
                @method('put')
                <ul class="profile-edit-list row p-0 m-0">
                    <li class="weight-500 col-md-12 d-flex">
                        <div class="form-group col-md-8">
                            <label class=" font-weight-bold">{{ __('words.newsTitle') }}</label>
                            <input name="title" class="form-control form-control-lg" type="text"
                            value="{{ $news->title }}">
                            @if($errors->any('title') && $errors->first('title'))
                                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" font-weight-bold">{{ __('words.newsImage') }}</label>
                            <input name="image" class="form-control form-control-lg " type="file">
                            @if($errors->any('image') && $errors->first('image'))
                                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </li>
                    <li class="weight-500 col-md-12">
                        <div class="form-group">
                            <label class=" font-weight-bold">{{ __('words.newsContent') }}</label>
                            <textarea name="content" id="bodyInput" class="form-control">{!! $news->body !!}</textarea>
                            @if($errors->any('content') && $errors->first('content'))
                                <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                        <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
                        <script>
                            ClassicEditor
                                .create( document.querySelector( '#bodyInput' ) )
                                .catch( error => {
                                    console.error( error );
                                } );
                        </script>
                    </li>
                    <div class="form-group pt-4 text-center w-100 ">
                        <input type="submit" class="btn p-3 font-weight-bold w-25 bg-blue text-light" value="{{ __('words.editNews') }}">
                    </div>
                </ul>
            </form>
        </div>
    </div>
    {{ session()->forget('errors') }}
@endsection
