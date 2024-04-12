@section('title')
{{ __('words.categories') }}
@endsection
@extends("backend.Layouts.master")

@extends('backend.Layouts.dataTable')


@section('content')
    <div class="container">
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
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if (Session::get('lang') == 'ar' )
                        <table class="table table-bordered" id="daterange_table" dir="rtl">
                    @elseif (Session::get('lang') == 'en')
                        <table class="table table-bordered" id="daterange_table" dir="ltr">
                    @else
                        <table class="table table-bordered" id="daterange_table" dir="ltr">
                    @endif
                        <thead >
                            <tr>
                                <th>{{ __('words.proName') }}</th>
                                <th>{{ __('words.discrption') }}</th>
                                <th style="min-width: 320px">{{ __('words.acion') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-weight-bold text-blue">
                        {{ __('words.sureDelete') }}
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('words.close') }}</button>
                        <form method="POST" action="{{route('category.destroy', '$post->id') }}"  >
                            @method('DELETE')
                            @csrf
                                <input type="hidden" name="id" id="id">
                                <button type="submit" class="btn btn-danger text-white font-weight-bold">{{ __('words.delete') }}</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scrpting')
    <script>
        $(function () {
            var table = $('#daterange_table').DataTable({
                processing : true,
                serverSide : true,
                ajax : {
                    url : "{{ route('prodecut.deleted') }}",
                },
                columns : [
                    @if (Session::get('lang'))
                        @if (Session::get('lang') == "ar")
                            {data : 'nameAr', name : 'nameAr'},
                            {data : 'descriptionAr', name : 'descriptionAr'},
                        @else
                            {data : 'nameEn', name : 'nameEn'},
                            {data : 'descriptionEn', name : 'descriptionEn', searchable: false},
                        @endif
                    @else
                        {data : 'nameEn', name : 'nameEn'},
                        {data : 'descriptionEn', name : 'descriptionEn', searchable: false},
                    @endif
                    {data : 'action', name : 'action' ,orderable : false, searchable: false},
                ]
            });

        });
    </script>
@endsection

