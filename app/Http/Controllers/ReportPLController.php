<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\ProfitLossChart;
use App\Income;
use App\Expense;

class ReportPLController extends Controller
{
    public function index(){


    return view('reports.profitloss.index');
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
    		$igrand= Income::whereDate('payment_date',$date)->sum('paid');
    		$egrand = Expense::whereDate('payment_date',$date)->sum('paid');
    		$result[]= array('labels' => $date, 'income' => $igrand, 'expense' => $egrand);
    	}
    	
    	return response()->json([
          'result' => $result
        ]);
    }
}
