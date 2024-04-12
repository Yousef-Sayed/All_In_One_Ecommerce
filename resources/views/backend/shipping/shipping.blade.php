@section('title')
{{ __('words.shipping') }}
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
    </script>
    <div class="card">
        <div class="card-header bg-white">
            <h3>
                <a href="{{ route('shipping.add') }}">{{ __('words.addNewArea') }}</a>
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (Session::get('lang') == 'ar' )
                    <table class="table table-bordered" id="daterange_table" dir="rtl">
                @else
                    <table class="table table-bordered" id="daterange_table" dir="ltr">
                @endif
                    <thead >
                        <tr>
                            <th>{{ __('words.areaname') }}</th>
                            <th>{{ __('words.areaValue') }} {{ __('words.currency') }}</th>
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
                    <form method="POST" action="{{route('shipping.delete', '$post->id') }}"  >
                        @method('DELETE')
                        @csrf
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-danger text-white font-weight-bold">{{ __('words.delete') }}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    {{ session()->forget('sucess') }}
@endsection

@section('scrpting')
    <script>
        $(function () {
            var table = $('#daterange_table').DataTable({
                processing : true,
                serverSide : true,
                ajax : {
                    url : "{{ route('shipping.index') }}",
                },
                columns : [
                    @if (Session::get('lang') == "ar")
                        {data : 'areaAr', name : 'areaAr'},
                    @else
                        {data : 'areaEn', name : 'areaEn'},
                    @endif
                    {data : 'value', name : 'value',orderable : false, searchable: false},
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

