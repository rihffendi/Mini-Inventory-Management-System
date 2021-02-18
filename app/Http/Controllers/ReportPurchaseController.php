<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\PurchaseChart;
use Illuminate\Support\Collection;
use App\Purchase;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class ReportPurchaseController extends Controller
{
    public function index(){

    	$purchase= Purchase::whereMonth('date', date('m'))
				 ->whereYear('date', date('Y'))
		         ->get();
		$today 	 = Purchase::whereDate('date', today())->sum('grand_total');
    	$monthly = Purchase::whereMonth('date', date('m'))
				 ->whereYear('date', date('Y'))
				 ->sum('grand_total');
		$weekly  = Purchase::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
				 ->sum('grand_total');
    	$chart   = new PurchaseChart;
    	$chart->labels([0]);
		$chart->dataset('Purchase', 'line', [0]);

		return view('reports.purchases.index',compact('chart','today','monthly','weekly'));
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
    		$grand= Purchase::whereDate('date',$date)->sum('grand_total');
    		$result[]= array('labels' => $date, 'data' => $grand);
    	}
    	
    	return response()->json([
          'result' => $result
        ]);
    }
}
