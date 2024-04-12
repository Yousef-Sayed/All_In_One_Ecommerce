@section('title')
{{ __('words.prodecuts') }}
@endsection
@extends("backend.Layouts.master")

@extends('backend.Layouts.dataTable')


@section('content')
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
        <div class="card-header bg-white">
            <h3>
                <a href="{{ route('prodecut.create') }}">{{ __('words.addNewPro') }} <i class="fas fa-plus"></i></a>
                <span style="margin: 0 5px"></span>
                <a class=" bg-danger" style="color:white" href="{{ route('prodecut.deleted') }}"><i class="fas fa-trash"></i> {{ __('words.recycleBin') }} ({{ DB::table('prodecuts')->whereNotNull('deleted_at')->count() }})</a>
            </h3>
        </div>
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
                            <th style="min-width: 200px">{{ __('words.discrption') }}</th>
                            <th>{{ __('words.proColor') }}</th>
                            <th>{{ __('words.proQuantity') }}</th>
                            <th>{{ __('words.proPrice') }}</th>
                            <th>{{ __('words.catName') }}</th>
                            <th style="min-width: 100px">{{ __('words.catCreate') }}</th>
                            <th style="min-width: 220px">{{ __('words.acion') }}</th>
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
                    <form method="POST" action="{{route('prodecut.destroy', '$post->id') }}"  >
                        @method('DELETE')
                        @csrf
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-danger text-white font-weight-bold">{{ __('words.delete') }}</button>
                        </form>
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
                    url : "{{ route('prodecut.index') }}",
                },
                columns : [
                    @if (Session::get('lang') == "ar")
                        {data : 'nameAr', name : 'nameAr'},
                        {data : 'descriptionAr', name : 'descriptionAr',orderable : false, searchable: false},
                        {data : 'colorAr', name : 'colorAr',orderable : false, searchable: false},
                    @else
                        {data : 'nameEn', name : 'nameEn'},
                        {data : 'descriptionEn', name : 'descriptionEn',orderable : false, searchable: false},
                        {data : 'colorEn', name : 'colorEn',orderable : false, searchable: false},
                    @endif
                    {data : 'quantity', name : 'quantity',orderable : false, searchable: false},
                    {data : 'price', name : 'price',orderable : false, searchable: false},
                    {data : 'categoryId', name : 'categoryId',orderable : false, searchable: false},
                    {data : 'created_at', name : 'created_at',orderable : false, searchable: false},
                    {data : 'action', name : 'action' ,orderable : false, searchable: false},
                ]
            });

        });
        // Delete Button
        $('#daterange_table tbody').on('click','#btnDelete',function(argument){
            var id = $(this).attr('data-id');
            // console.log(id);
            $('#deleteModal #id').val(id)
        });
    </script>
@endsection

