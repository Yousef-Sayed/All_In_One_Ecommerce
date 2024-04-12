@section('title')
{{ __('words.orders') }}
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
                            <th>{{ __('words.customerName') }}</th>
                            <th>{{ __('words.piecesNumber') }}</th>
                            <th>{{ __('words.totalOrder') }} {{ __('words.currency') }}</th>
                            <th style="min-width: 120px">{{ __('words.orderCode') }} </th>
                            <th>{{ __('words.orderStatus') }} </th>
                            <th style="min-width: 100px">{{ __('words.catCreate') }}</th>
                            <th style="min-width: 280px">{{ __('words.acion') }}</th>
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
                    <form method="POST" action="{{ route('orders.deletess','00') }}">
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
                    url : "{{ route('orders.index') }}",
                },
                columns : [
                    {data : 'shipping_name', name : 'shipping_name'},
                    {data : 'product_count', name : 'product_count',orderable : false, searchable: false},
                    {data : 'total_amount', name : 'total_amount',orderable : false, searchable: false},
                    {data : 'order_code', name : 'order_code',orderable : false},
                    {data : 'order_status', name : 'order_status',orderable : false},
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

