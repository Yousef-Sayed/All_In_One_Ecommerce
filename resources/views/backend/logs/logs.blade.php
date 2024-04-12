@section('title')
{{ __('words.logs') }}
@endsection
@extends("backend.Layouts.master")

@extends('backend.Layouts.dataTable')


@section('content')
        <div class="card-body">
            <div class="table-responsive">
                    @if (Session::get('lang') == 'ar' )
                        <table class="table table-bordered" id="daterange_table" dir="rtl">
                    @else
                        <table class="table table-bordered" id="daterange_table" dir="ltr">
                    @endif
                    <thead>
                        <tr>
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
                    url : "{{ route('logs.index') }}",
                },
                columns : [
                    {data : 'action', name : 'action' ,orderable : false, searchable: false},
                ],
                searching: false
            });
        });
    </script>
@endsection

