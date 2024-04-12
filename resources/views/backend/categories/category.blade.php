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
            <div class="card-header bg-white">
                <h3>
                    <a href="{{ route('category.create') }}">
                        {{ __('words.addNewCat') }}
                        <i class="fas fa-plus"></i>
                    </a>
                    <span style="margin: 0 5px"></span>
                    <a class=" bg-danger" style="color:white" href="{{ route('category.deleted') }}">
                        <i class="fas fa-trash"></i>
                        {{ __('words.recycleBin') }}
                        ({{ DB::table('categories')->whereNotNull('deleted_at')->count() }})
                    </a>
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
                                <th width="20px">{{ __('words.id') }}</th>
                                <th>{{ __('words.catName') }}</th>
                                <th>{{ __('words.discrption') }}</th>
                                <th width="100px">{{ __('words.catCreate') }}</th>
                                <th width="200px">{{ __('words.acion') }}</th>
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
                    url : "{{ route('category.index') }}",
                },
                columns : [
                    {data : 'id', name : 'id'},
                    @if (Session::get('lang'))
                        @if (Session::get('lang') == "ar")
                            {data : 'nameAr', name : 'nameAr'},
                            {data : 'discriptionAr', name : 'discriptionAr'},
                        @else
                            {data : 'nameEn', name : 'nameEn'},
                            {data : 'discriptionEn', name : 'discriptionEn'},
                            @endif
                        @else
                            {data : 'nameEn', name : 'nameEn'},
                            {data : 'discriptionEn', name : 'discriptionEn'},
                    @endif
                    {data : 'created_at', name : 'created_at'},
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

