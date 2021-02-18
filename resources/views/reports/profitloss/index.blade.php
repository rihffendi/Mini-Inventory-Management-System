@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Report</span>
    <h3 class="page-title">View Profit & Loss Report</h3>
  </div>
</div>
<!-- End Page Header -->
        <div class="row">
            <div class="col-4">
                <div class="form-group pb-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><strong>Year</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
                        </div>
                        <select class="form-control silver" name="year" id="year">
                            <option value="" selected> Select Year</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group pb-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><strong>Month</strong>  <i class="fa fa-asterisk custom-star text-danger" data-placement ="top" aria-hidden="true"></i></span>
                        </div>
                        <select class="form-control silver" name="month" id="month">
                            <option value="" selected> Select Month</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card card-small">
            <div class="card-header bg-darkish text-white">
                Monthly Profit & Loss Progress Report
            </div>  
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script>
$(document).ready(function() {
  var ctx = document.getElementById("myChart");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Income',
        data: [],
        backgroundColor: [
                'rgba(0, 184, 230, 0.8)'
            ],
        borderWidth: 1,
        showLines: true
      },
      {
        label: 'Expense',
        data: [],
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

$('body').on('change','#year',function(){
    $('#month').val('');
});
var updateChart = function(){
    $('body').on('change', '#month', function(e){
        var year = $('#year').val();
        var month = e.target.value;

       $.ajax({
          url: "{{ route('reports.profitloss.fetch') }}",
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            year : year,
            month : month
          },
          success: function(data) {
            // console.log(data);
                var clabels =[];
                var cincome = [];
                var cexpense = [];
                $.each(data.result,function(index,value){
                  
                    clabels.push(value.labels);
                    cincome.push(value.income);
                    cexpense.push(value.expense);
                });
               myChart.data.labels = clabels;
               myChart.data.datasets[0].data = cincome;
               myChart.data.datasets[1].data = cexpense;
               myChart.update();
          },
          error: function(data){
            // console.log(data);
          }
        });
    });
}
updateChart();

});
</script>
@endsection
