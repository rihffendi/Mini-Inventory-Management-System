<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SaleChart;
use Illuminate\Support\Collection;
use App\Sale;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class ReportSaleController extends Controller
{
    public function index(){

  	$sale= Sale::whereMonth('date', date('m'))
				 ->whereYear('date', date('Y'))
         ->get();
		$today 	 = Sale::whereDate('date', today())->sum('grand_total');
	  $monthly = Sale::whereMonth('date', date('m'))
				 ->whereYear('date', date('Y'))
				 ->sum('grand_total');
		$weekly  = Sale::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
				 ->sum('grand_total');

  	$chart   = new SaleChart;
  	$chart->labels(['jan','feb','march']);
		$chart->dataset('Sale', 'line', [0,0,0]);

		return view('reports.sales.index',compact('chart','today','monthly','weekly'));
    }


      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
    	$dayCount = date('t', strtotime('01-'. $request->month . '-' . $request->year));
    	$year = $request->year;
    	$month = $request->month;
    	$result = array();

    	for($i=1; $i<=$dayCount; $i++){
    		$date = $year.'-'.$month.'-'.$i;
    		// die(var_dump($date));
    		$grand= Sale::whereDate('date',$date)->sum('grand_total');
    		$result[]= array('labels' => $date, 'data' => $grand);
    	}
    	
    	return response()->json([
          'result' => $result
        ]);
    }
}
