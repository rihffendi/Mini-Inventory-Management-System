<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Expense;
use App\Expense_total;
use App\Purchase;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $expense = Expense::join('suppliers','suppliers.id','=', 'expenses.supplier_id')
                  ->select('suppliers.name as iname',
                           'expenses.payment_type as itype',
                           'expenses.payment_date as idate',
                           'expenses.paid as ipaid',
                           'expenses.id as iid' 
                    )
                    ->orderBy('expenses.created_at', 'desc')
                    ->get();
        return view('accounts.expenses.index')->with('expense', $expense);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::where('status','=',1)->get();

        return view('accounts.expenses.create')->with([
            'supplier' => $supplier
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
        
        if($request->supplier > 0){
            $expense_total = Expense_total::where('supplier_id','=', $request->supplier)->first();
            $purchase= Purchase::where('supplier_id','=', $request->supplier)->sum('grand_total');
            if($expense_total){
                $supplier=$expense_total->outstanding;
            }
            elseif($purchase){
                $supplier = $purchase;
            }
            else{
                $supplier = 0;
            }


            return response()->json([
              'supplier' => $supplier
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
        $expense = new Expense();
        $expense->supplier_id = $request->supplier_id;
        $expense->payment_type = $request->payment_type;
        $expense->payment_date = $request->payment_date;
        $expense->paid = $request->paid;
        $expense->details = $request->details;
        $expense->save();

        $expense_total = Expense_total::where('supplier_id','=',$request->supplier_id)->first();

        if($expense_total->outstanding < 0){
            $expense_total->outstanding = $request->paid + $expense_total->outstanding;
        }
        else{
            $expense_total->outstanding = $expense_total->outstanding - $request->paid;
        }
        $expense_total->update(['outstanding' => $expense_total->outstanding]);

        return redirect()->route('accounts.expenses.index')->with('success','Purchase Created Successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::join('suppliers','suppliers.id','=', 'expenses.supplier_id')
                  ->join('expense_totals','expense_totals.supplier_id','=', 'expenses.supplier_id')
                  ->select('suppliers.name as iname',
                           'expenses.payment_type as itype',
                           'expenses.payment_date as idate',
                           'expenses.paid as ipaid',
                           'expenses.details as idetails',
                           'expense_totals.outstanding as ioutstanding')
                    ->where('expenses.id','=', $id)
                    ->first();
        return view('accounts.expenses.show')->with('expense', $expense);
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
