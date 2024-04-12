@section('title')
{{ __("words.dashboard") }}
@endsection
@extends("backend.Layouts.master")

@section('content')
    <div class="row">
        <a href="{{ route('admins') }}" class="col-xl-3 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="fas fa-user-tie" style="font-size: 45px"></i>
                    </div>
                    <div class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.admines') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('admins')->where('status',1)->get()->count() }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('users') }}" class="col-xl-3 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="far fa-user" style="font-size: 45px"></i>
                    </div>
                    <div class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.customers') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('users')->where('status',1)->get()->count() }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.testimonial') }}" class="col-xl-3 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="fas fa-comments" style="font-size: 45px"></i>
                    </div>
                    <dic class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.testimonial') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('testimomials')->get()->count() }}</div>
                    </dic>
                </div>
            </div>
        </a>
        <a href="{{ route('news.index') }}" class="col-xl-3 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="far fa-newspaper" style="font-size: 45px"></i>
                    </div>
                    <div class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.news') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('news')->get()->count() }}</div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('category.index') }}" class="col-xl-4 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="fas fa-sitemap" style="font-size: 45px"></i>
                    </div>
                    <div  class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.categories') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('categories')->get()->count() }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('prodecut.index') }}" class="col-xl-4 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="fab fa-product-hunt" style="font-size: 45px"></i>
                    </div>
                    <div class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.prodecuts') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('prodecuts')->whereNull('deleted_at')->get()->count() }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('orders.index') }}" class="col-xl-4 col-sm-6 col-xs-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="w-25 text-center">
                        <i class="fas fa-box" style="font-size: 45px"></i>
                    </div>
                    <div  class="widget-data w-75">
                        <div class="weight-600 font-22 text-center">{{ __('words.orders') }}</div>
                        <div class="h4 mb-0 mt-2 text-center">{{ DB::table('orders')->get()->groupBy('order_code')->count() }}</div>
                    </div>
                </div>
            </div>
        </a>
        <div class="col-xl-6 col-xs-6 col-sm-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center flex-xl-column">
                    <div class="w-xl-100 w-25 text-center">
                        <i class="fas fa-check" style="font-size: 45px"></i>
                    </div>
                    <div class="widget-data w-xl-100 w-75 text-xl-center mt-xl-2 p-xl-2">
                        <div class="h4 mb-0">{{ DB::table('orders')->where('order_status',1)->get()->groupBy('order_code')->count()}}</div>
                        <div class="weight-600 font-22">{{ __('words.deliveredOrders') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xs-6 col-sm-6 mb-30" style="color:#051922">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center flex-xl-column">
                    <div class="w-xl-100 w-25 text-center">
                        <i class="fas fa-eye" style="font-size: 45px"></i>
                    </div>
                    <div class="widget-data w-xl-100 w-75 text-xl-center mt-xl-2 p-xl-2">
                        <div class="h4 mb-0">0</div>
                        <div class="weight-600 font-14">{{ __('words.views') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div style="width: 100%; margin: 10px auto;background-color: #ecf0f4;color:white">
            <canvas id="barChart"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($output['labels']),
                    datasets: [{
                        label: 'Sales' + ' ' + {{ date('Y') }},
                        data: @json($output['data']),
                        backgroundColor: 'rgba(5, 25, 34, 0.2)',
                        borderColor: 'rgba(5, 25, 34, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
@endsection
