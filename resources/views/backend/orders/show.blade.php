@section('title')
{{ __('words.orderDetails') }}
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
        @if($errors->any('quantity') && $errors->first('quantity'))
                <div class="alert alert-danger">{{ $errors->first('quantity') }}</div>
        @endif
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
                            <th>{{ __('words.proPrice') }} {{ __('words.currency') }}</th>
                            <th>{{ __('words.proQuantity') }} </th>
                            <th>{{ __('words.totalPrice') }}</th>
                            <th style="min-width: 220px">{{ __('words.acion') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                    <form method="POST" action="{{route('orders.destroy', '$post->id') }}"  >
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
    {{ session()->forget('errors') }}
@endsection

@section('scrpting')
    <script>
        $(function () {
            var table = $('#daterange_table').DataTable({
                processing : true,
                serverSide : true,
                ajax : {
                    url : "{{ route('orders.show',$idShow) }}",
                },
                columns : [
                    {data : 'name', name : 'name'},
                    {data : 'price', name : 'price',orderable : false, searchable: false},
                    {data : 'quantity', name : 'quantity',orderable : false, searchable: false},
                    {data : 'total', name : 'total',orderable : false, searchable: false},
                    {data : 'action', name : 'action',orderable : false, searchable: false},
                ]
            });


        });
        // Delete Button
        $('#daterange_table tbody').on('click','#btnDelete',function(argument){
            var id = $(this).attr('data-id');
            // console.log(id);
            $('#deleteModal #id').val(id)
        });

        function updateQuantityOrder() {

            document.getElementById('quantity-change-form').submit();
        }
    </script>

@endsection

