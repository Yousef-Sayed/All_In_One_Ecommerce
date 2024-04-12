@foreach ($tablesWithSoftDeletes as $table)
    <h1>{{ $table }}</h1>
    @foreach (DB::select("select * from ".$table." where deleted_at IS NOT NULL") as $t)
        @foreach ($t as $tt)
            <div>{{ $tt }}</div>
        @endforeach
        @endforeach
    <hr>
@endforeach
