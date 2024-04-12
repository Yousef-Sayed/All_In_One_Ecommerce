@section('title')
{{ __('words.news') }}
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
                    <a href="{{ route('news.create') }}">{{ __('words.addNewNews') }} <i class="fas fa-plus"></i></a>
                    <span style="margin: 0 5px"></span>
                    <a class=" bg-danger" style="color:white" href="{{ route('news.deleted') }}">
                        <i class="fas fa-trash"></i>
                         {{ __('words.recycleBin') }}
                        ({{ DB::table('news')->whereNotNull('deleted_at')->count() }})
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
                                <th>{{ __('words.newsTitle') }}</th>
                                <th width="500px">{{ __('words.newsContent') }}</th>
                                <th width="100px">{{ __('words.status') }}</th>
                                <th width="100px">{{ __('words.catCreate') }}</th>
                                <th>{{ __('words.acion') }}</th>
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
                        <form method="POST" action="{{route('news.delete', '$post->id') }}">
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
                    url : "{{ route('news.index') }}",
                },
                columns : [
                    {data : 'title', name : 'title'},
                    {data : 'body', name :  'body'},
                    {data : 'show', name : 'show',orderable : false, searchable: false},
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

