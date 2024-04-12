@section('linksDataView')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('backend/dataTable/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('backend/dataTable/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('backend/dataTable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/dataTable/js/bootstrap.bundle.min.js') }}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/dataTable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/dataTable/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/dataTable/js/daterangepicker.min.js') }}"></script>
@endsection
