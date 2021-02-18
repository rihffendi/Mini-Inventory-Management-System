@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Dashboard</span>
    <h3 class="page-title">Overview</h3>
  </div>
</div>
<!-- End Page Header -->
<!-- Small Stats Blocks -->
<div class="row">
  <div class="col-lg col-md-6 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Today Sale</span>
            <h6 class="stats-small__value count my-3">{{$today}}</h6>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-1"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg col-md-6 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Weekly Sale</span>
            <h6 class="stats-small__value count my-3">{{$weekly}}</h6>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-2"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg col-md-4 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Monthly Sale</span>
            <h6 class="stats-small__value count my-3">{{$monthly}}</h6>
          </div>
          
        </div>
        <canvas height="120" class="blog-overview-stats-small-3"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg col-md-4 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Customer</span>
            <h6 class="stats-small__value count my-3">{{$customer}}</h6>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-4"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg col-md-4 col-sm-12 mb-4">
    <div class="stats-small stats-small--1 card card-small">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Supplier</span>
            <h6 class="stats-small__value count my-3">{{$supplier}}</h6>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-5"></canvas>
      </div>
    </div>
  </div>
</div>
<!-- End Small Stats Blocks -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card card-small">
            <div class="card-header bg-darkish text-white">
                Current Month Profit & Loss Graph
            </div>  
            <div class="card-body">
               <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="{{asset('js/shards-dashboards.1.1.0.min.js')}}"></script>
<script src="{{asset('js/extras.1.1.0.min.js')}}"></script>
<script src="{{asset('js/app/app-blog-overview.1.1.0.js')}}"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
<script>
  var ctx = document.getElementById("myChart");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! $labels !!},
      datasets: [{
        label: 'Income',
        data: {!! $income !!},
        backgroundColor: [
                'rgba(0, 184, 230, 0.8)'
            ],
        borderWidth: 1,
        showLines: true
      },
      {
        label: 'Expense',
        data: {!! $expense !!},
        backgroundColor: ['rgba(204, 0, 204, 0.8)'] ,
        borderWidth: 1,
        showLines: true
      }]
    },
 options: {
    spanGaps: true,
    responsive: true,
    title: {
      display: true,
      text: 'Compare Your Income & Expense'
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true
    },
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Day of a month'
        }
      }],
      yAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Income & Expense'
        },
        ticks: {
          beginAtZero:true,
          precision:0
        },
        stacked: true
      }]
    }
  }
  });
</script>
@endsection
