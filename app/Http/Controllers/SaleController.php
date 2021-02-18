<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Sale;
use App\Sale_product;
use App\Purchase_product;
use App\Stock;
use App\Income;
use App\Income_total;
use PDF;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = Sale::join('customers','customers.id','=','sales.customer_id')
        ->select('customers.name as scustomer',
                 'sales.invoice_no as sinv',
                 'sales.date as sdate',
                 'sales.grand_total as stotal',
                 'sales.id as sid',
                 'sales.status as sstatus'
                )
        ->get();
        return view('sales.index')->with('sale',$sale);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::where('status','=',1)->get();
        return view('sales.create')->with('customer', $customer);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $product = Product::all();
        return response()->json([
          'product' => $product
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invcheck(Request $request)
    {   
        
        $invcheck = Sale::where('invoice_no','=',$request->invcheck)->first();
        return response()->json([
          'invcheck' => $invcheck
          
        ]);
    }
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatecheck(Request $request)
    {   
        $sale = Sale_product::select('quantity')
                ->where('invoice_no','=', $request->invo)
                ->where('product_id','=', $request->product_id)
                ->first();
        $stock = Stock::where('product_id','=',$request->product_id)->first();

        if($sale){
            if($request->quantity > $sale->quantity){
                $check =  $request->quantity - $sale->quantity;
                if($check > $stock->quantity ){
                    $error = "Out of Stock";
                    return response()->json([
                        'error' => $error
                    ]);
                }
                else{
                    return response()->json('Stock In', 200);
                }
            }
            else{
                return response()->json('Stock In', 200);
            }
        }
        else{
            if($request->quantity > $stock->quantity){
                $error = "Out of Stock";
                    return response()->json([
                        'error' => $error
                    ]);
            }
            else{
                return response()->json('Stock In', 200);
            }
        }
   
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function singledata(Request $request)
    {   
        
        if($request->product > 0){
            $product = Product::where('id','=',$request->product)->get();
            $tquantity = Stock::where('product_id','=', $request->product)->first();
            return response()->json([
              'product' => $product,
              'tquantity' => $tquantity
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
        $data = count($request->selectProduct);
        $trim = str_replace(' ', '', $request->invoice_no); 
    
         for ($i=0; $i < $data; $i++) { 
                Sale_product::create([
                'invoice_no' => $trim,
                'product_id' => $request->selectProduct[$i],
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
                'tax' =>$request->tax[$i],
                'total' => $request->total[$i]
            ]);
           $stock = Stock::where('product_id','=',$request->selectProduct[$i])->first();
           $rest = $stock->quantity -  $request->quantity[$i];
           $stock->update(['quantity' => $rest]);
        }

        $sale = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->status = $request->status;
        $sale->date = $request->date;
        $sale->invoice_no = $trim;
        $sale->grand_total = $request->grand;

        $sale->save();

        $income_total = Income_total::where('customer_id','=',$request->customer_id)->first();


        if($income_total){
           $income_total->outstanding =  $income_total->outstanding + $request->grand;
           $income_total->update(['outstanding' => $income_total->outstanding]);
        }
        else{
            Income_total::create([
                'customer_id' => $request->customer_id,
                'outstanding' => $request->grand
            ]);
        }

        return redirect()->route('sales.index')->with('success','Purchase Created Successfully');  
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale_product::join('sales','sales.invoice_no','=','sale_products.invoice_no')
        ->join('products', 'products.id','=','sale_products.product_id')
        ->join('customers','customers.id','=','sales.customer_id')
        ->select('products.name as sproduct',
                 'sale_products.quantity as squantity',
                 'sale_products.price as sprice',
                 'sale_products.total as stotal',
                 'sale_products.tax as stax',
                 'sales.id as sid'
                )
        ->where('sales.id','=',$id)
        ->get();


        return view('sales.show')->with('sale', $sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        $customer = Customer::where('status','=',1)->get();
        $product = Product::all();
        $product_detail = Sale_product::join('sales','sales.invoice_no','=','sale_products.invoice_no')
        ->join('products', 'products.id','=','Sale_products.product_id')
        ->join('customers','customers.id','=','sales.customer_id')
        ->join('stocks','stocks.product_id','=','products.id')
        ->select('products.name as pproduct',
                 'sale_products.quantity as pquantity',
                 'sale_products.price as pprice',
                 'sale_products.total as ptotal',
                 'sale_products.tax as ptax',
                 'sale_products.product_id as proid',
                 'sale_products.id as ppid',
                 'stocks.quantity as stockq'
                )
        ->where('sales.id','=',$id)
        ->get();

        return view('sales.edit')->with([
                'sale' => $sale,
                'customer' => $customer,
                'product_detail' => $product_detail,
                'product' => $product
        ]);
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

         $trim = str_replace(' ', '', $request->invoice_no); 
         $del = Sale_product::where('invoice_no','=', $trim)
                ->whereNotIn('product_id',$request->selectProduct)->
                delete();
         // dd($request->all());

        $data = count($request->selectProduct);
    
        for ($i=0; $i < $data; $i++) { 
            $saleQuantity = Sale_product::where('invoice_no', $trim)
                            ->where('product_id','=',$request->selectProduct[$i])
                            ->first();
            if($saleQuantity){
                if($request->quantity[$i] > $saleQuantity->quantity){
                    $extra = $request->quantity[$i] - $saleQuantity->quantity;
                    $stock = Stock::where('product_id','=',$request->selectProduct[$i])->first();
                    if($stock->quantity >= $extra){
                        Stock::where('product_id','=',$request->selectProduct[$i])->decrement('quantity', $extra);
                    }
                }

                if($saleQuantity->quantity > $request->quantity[$i]){
                    $extra = $saleQuantity->quantity - $request->quantity[$i];
                    Stock::where('product_id','=',$request->selectProduct[$i])->increment('quantity', $extra);

                }
            }  
            else{
                $stock = Stock::where('product_id','=',$request->selectProduct[$i])->first();
                if($stock->quantity >= $request->quantity[$i]){
                    Stock::where('product_id','=',$request->selectProduct[$i])
                           ->decrement('quantity', $request->quantity[$i]);
                }
            } 
            
            Sale_product::updateOrInsert(
                [
                    'invoice_no' => $trim ,'product_id' => $request->selectProduct[$i]
                ],
                [
                    'invoice_no' => $trim,
                    'product_id' => $request->selectProduct[$i],
                    'price' => $request->price[$i],
                    'quantity' => $request->quantity[$i],
                    'tax' =>$request->tax[$i],
                    'total' => $request->total[$i]
                ]
            );

        }

        $sale = Sale::find($id);
        $sale->customer_id = $request->customer_id;
        $sale->status = $request->status;
        $sale->date = $request->date;
        $sale->invoice_no = $trim;
        $sale->grand_total = $request->grand;
        $sale->save();

        $update = Sale::where('customer_id','=', $request->customer_id)->sum('grand_total');
        $income = Income::where('customer_id','=',$request->customer_id)->sum('paid');
        $income_total = Income_total::where('customer_id', $request->customer_id)->first();
        $income_total->outstanding = $update - $income;
        $income_total->save();
       

        return redirect()->route('sales.index')->with('success','Updated Successfully'); 
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function invoice($id) {
        
        $sale = Sale::find($id);

        $customer = Customer::where('id','=', $sale->customer_id)->first();

        $invoice = Sale::join('sale_products','sale_products.invoice_no','=','sales.invoice_no') 
                 ->join('products','products.id','=','sale_products.product_id')
                 ->select(
                    'products.name as iproduct',
                    'sale_products.price as iprice',
                    'sale_products.quantity as iquan',
                    'sale_products.tax as itax',
                    'sale_products.total as isubtotal'
                )
                ->where('sales.invoice_no','=',$sale->invoice_no)
                ->get();
        // dd($sale,$customer,$invoice);
        return view('sales.invoice')->with([
            'sale' => $sale,
            'customer' => $customer,
            'invoice' => $invoice
        ]);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id){
        $sale = Sale::find($id);

        $customer = Customer::where('id','=', $sale->customer_id)->first();

        $invoice = Sale::join('sale_products','sale_products.invoice_no','=','sales.invoice_no') 
                 ->join('products','products.id','=','sale_products.product_id')
                 ->select(
                    'products.name as iproduct',
                    'sale_products.price as iprice',
                    'sale_products.quantity as iquan',
                    'sale_products.tax as itax',
                    'sale_products.total as isubtotal'
                )
                ->where('sales.invoice_no','=',$sale->invoice_no)
                ->get();

        $pdf = PDF::loadView('sales.download',compact('sale','customer','invoice'));
        return $pdf->download('sale_invoice.pdf');
       
    }
}
