<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Customer;
use App\Supplier;
use Carbon\Carbon;
use App\Income;
use App\Expense;

class DashboardController extends Controller
{
 
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::where('status',1)->count();
        $supplier = Supplier::where('status',1)->count();
        $today   = Sale::whereDate('date', today())->count();
        $monthly = Sale::whereMonth('date', date('m'))
                 ->whereYear('date', date('Y'))
                 ->count();
        $weekly  = Sale::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->       endOfWeek()])->count();

        $dayCount = date('t', strtotime('01-'. Carbon::now()->format('m') . '-' . Carbon::now()->format('Y')));

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $labels = collect();
        $income = collect();
        $expense = collect();
        for($i=1; $i<=$dayCount; $i++){
            $date = $year.'-'.$month.'-'.$i;
            $igrand= Income::whereDate('payment_date',$date)->sum('paid');
            $egrand = Expense::whereDate('payment_date',$date)->sum('paid');
            $labels->push($date);
            $income->push($igrand);
            $expense->push($egrand);
        }

    return view('dashboard.index',compact('labels','income','expense','customer','supplier','today','monthly','weekly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
