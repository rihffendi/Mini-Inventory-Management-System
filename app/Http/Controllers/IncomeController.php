<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Income;
use App\Income_total;
use App\Sale;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Income::join('customers','customers.id','=', 'incomes.customer_id')
                  ->select('customers.name as iname',
                           'incomes.payment_type as itype',
                           'incomes.payment_date as idate',
                           'incomes.paid as ipaid',
                           'incomes.id as iid' 
                    )
                    ->orderBy('incomes.created_at', 'desc')
                    ->get();
        return view('accounts.incomes.index')->with('income',$income);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::where('status','=',1)->get();

        return view('accounts.incomes.create')->with([
            'customer' => $customer
        ]);
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function singledata(Request $request)
    {   
        
        if($request->customer > 0){
            $income_total = Income_total::where('customer_id','=', $request->customer)->first();
            $sales= Sale::where('customer_id','=', $request->customer)->sum('grand_total');
            if($income_total){
                $customer=$income_total->outstanding;
            }
            elseif($sales){
                $customer = $sales;
            }
            else{
                $customer = 0;
            }


            return response()->json([
              'customer' => $customer
            ]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $income = new Income();
        $income->customer_id = $request->customer_id;
        $income->payment_type = $request->payment_type;
        $income->payment_date = $request->payment_date;
        $income->paid = $request->paid;
        $income->details = $request->details;
        $income->save();

        $income_total = Income_total::where('customer_id','=',$request->customer_id)->first();

        if($income_total->outstanding < 0){
            $income_total->outstanding = $request->paid + $income_total->outstanding;
        }
        else{
            $income_total->outstanding = $income_total->outstanding - $request->paid;
        }
        $income_total->update(['outstanding' => $income_total->outstanding]);

        return redirect()->route('accounts.incomes.index')->with('success','Purchase Created Successfully');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $income = Income::join('customers','customers.id','=', 'incomes.customer_id')
                  ->join('income_totals','income_totals.customer_id','=', 'incomes.customer_id')
                  ->select('customers.name as iname',
                           'incomes.payment_type as itype',
                           'incomes.payment_date as idate',
                           'incomes.paid as ipaid',
                           'incomes.details as idetails',
                           'income_totals.outstanding as ioutstanding')
                    ->where('incomes.id','=', $id)
                    ->first();
        return view('accounts.incomes.show')->with('income', $income);
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
