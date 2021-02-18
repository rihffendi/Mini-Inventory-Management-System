<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Supplier;
use App\Purchase;
use App\Purchase_product;
use App\Stock;
use App\Expense_total;
use PDF;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Purchase::join('suppliers','suppliers.id','=','purchases.supplier_id')
        ->select('suppliers.name as psupplier',
                 'purchases.invoice_no as pinv',
                 'purchases.date as pdate',
                 'purchases.grand_total as ptotal',
                 'purchases.id as pid',
                 'purchases.status as pstatus'
                )
        ->get();
        return view('purchases.index')->with('purchase', $purchase);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::where('status','=',1)->get();
        return view('purchases.create')->with('supplier',$supplier);
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
    public function singledata(Request $request)
    {   
        
        if($request->product > 0){
            $product = Product::where('id','=',$request->product)->get();
            return response()->json([
              'product' => $product
            ]);
        }
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invcheck(Request $request)
    {   
        
        $invcheck = Purchase::where('invoice_no','=',$request->invcheck)->first();
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
    public function store(Request $request)
    {   
        // dd($request->all());

        $data = count($request->selectProduct);
        $trim = str_replace(' ', '', $request->invoice_no); 
    
         for ($i=0; $i < $data; $i++) { 
            Purchase_product::create([
                'invoice_no' => $trim,
                'product_id' => $request->selectProduct[$i],
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
                'tax' =>$request->tax[$i],
                'total' => $request->total[$i]
            ]);
        }

        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->status = $request->status;
        $purchase->date = $request->date;
        $purchase->invoice_no = $trim;
        $purchase->grand_total = $request->grand;

        $purchase->save();


        $stock = Purchase_product::select('purchase_products.product_id')->selectRaw("SUM(quantity) as total_quan")->groupBy('product_id')->get();

        foreach($stock as $stocks){
            $check = Stock::where('product_id','=', $stocks->product_id)->first();

            if($check){
                $check = Stock::where('product_id','=', $stocks->product_id)->update(['quantity' => $stocks->total_quan]);
            }
            else{
                Stock::create([
                    'product_id' => $stocks->product_id,
                    'quantity' => $stocks->total_quan
                ]);
            }
        }

        $expense_total = Expense_total::where('supplier_id','=',$request->supplier_id)->first();


        if($expense_total){
           $expense_total->outstanding =  $expense_total->outstanding + $request->grand;
           $expense_total->update(['outstanding' => $expense_total->outstanding]);
        }
        else{
            Expense_total::create([
                'supplier_id' => $request->supplier_id,
                'outstanding' => $request->grand
            ]);
        }

        return redirect()->route('purchases.index')->with('success','Purchase Created Successfully');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $purchase = Purchase_product::join('purchases','purchases.invoice_no','=','purchase_products.invoice_no')
        ->join('products', 'products.id','=','purchase_products.product_id')
        ->join('suppliers','suppliers.id','=','purchases.supplier_id')
        ->select('products.name as pproduct',
                 'purchase_products.quantity as pquantity',
                 'purchase_products.price as pprice',
                 'purchase_products.total as ptotal',
                 'purchase_products.tax as ptax',
                 'purchases.id as pid'
                )
        ->where('purchases.id','=',$id)
        ->get();


        return view('purchases.show')->with('purchase', $purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $supplier = Supplier::where('status','=',1)->get();
        $product = Product::all();
        $product_detail = Purchase_product::join('purchases','purchases.invoice_no','=','purchase_products.invoice_no')
        ->join('products', 'products.id','=','purchase_products.product_id')
        ->join('suppliers','suppliers.id','=','purchases.supplier_id')
        ->select('products.name as pproduct',
                 'purchase_products.quantity as pquantity',
                 'purchase_products.price as pprice',
                 'purchase_products.total as ptotal',
                 'purchase_products.tax as ptax',
                 'purchase_products.product_id as proid',
                 'purchase_products.id as ppid'
                )
        ->where('purchases.id','=',$id)
        ->get();

        return view('purchases.edit')->with([
                'purchase' => $purchase,
                'supplier' => $supplier,
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
        $deduct = Purchase_product::where('invoice_no','=', $trim)
               ->whereNotIn('product_id',$request->selectProduct)
               ->get();
        // dd($deduct);
        foreach($deduct as $deducts){
            Stock::where('product_id', $deducts->product_id)->decrement('quantity', $deducts->quantity);
            $deducts->delete();
        }
        

        $data = count($request->selectProduct);
    
         for ($i=0; $i < $data; $i++) { 

          $purchaseQuantity =  Purchase_product::where('invoice_no', $trim)
                        ->where('product_id','=',$request->selectProduct[$i])
                        ->first();
          
            if($purchaseQuantity){
                   if($request->quantity[$i] > $purchaseQuantity->quantity){
                    $extra = $request->quantity[$i] - $purchaseQuantity->quantity;
                    $stock = Stock::where('product_id','=',$request->selectProduct[$i])->first();
                    if($stock->quantity >= $extra){
                        Stock::where('product_id','=',$request->selectProduct[$i])->decrement('quantity', $extra);
                    }
                }

                if($purchaseQuantity->quantity > $request->quantity[$i]){
                    $extra = $purchaseQuantity->quantity - $request->quantity[$i];
                    Stock::where('product_id','=',$request->selectProduct[$i])->increment('quantity', $extra);

                }
            }

             Purchase_product::updateOrInsert(
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
        $sumStock = Purchase_product::select('purchase_products.product_id')->selectRaw("SUM(quantity) as total_quan")->groupBy('product_id')->get();


         foreach($sumStock as $sumStocks){
            $check = Stock::where('product_id','=', $sumStocks->product_id)->first();

            if($check){
                $check = Stock::where('product_id','=', $sumStocks->product_id)->update(['quantity' => $sumStocks->total_quan]);
            }
            else{
                Stock::create([
                    'product_id' => $sumStocks->product_id,
                    'quantity' => $sumStocks->total_quan
                ]);
            }
        }

        $purchase = Purchase::find($id);
        $purchase->supplier_id = $request->supplier_id;
        $purchase->status = $request->status;
        $purchase->date = $request->date;
        $purchase->invoice_no = $trim;
        $purchase->grand_total = $request->grand;

        $purchase->save();
        
      

        return redirect()->route('purchases.index')->with('success','Updated Successfully'); 
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
        
        $purchase = Purchase::find($id);

        $supplier = Supplier::where('id','=', $purchase->supplier_id)->first();

        $invoice = Purchase::join('purchase_products','purchase_products.invoice_no','=','purchases.invoice_no') 
                 ->join('products','products.id','=','purchase_products.product_id')
                 ->select(
                    'products.name as iproduct',
                    'purchase_products.price as iprice',
                    'purchase_products.quantity as iquan',
                    'purchase_products.tax as itax',
                    'purchase_products.total as isubtotal'
                )
                ->where('purchases.invoice_no','=',$purchase->invoice_no)
                ->get();
        // dd($sale,$customer,$invoice);
        return view('purchases.invoice')->with([
            'purchase' => $purchase,
            'supplier' => $supplier,
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
        $purchase = Purchase::find($id);
        $supplier = Supplier::where('id','=', $purchase->supplier_id)->first();

        $invoice = Purchase::join('purchase_products','purchase_products.invoice_no','=','purchases.invoice_no') 
                 ->join('products','products.id','=','purchase_products.product_id')
                 ->select(
                    'products.name as iproduct',
                    'purchase_products.price as iprice',
                    'purchase_products.quantity as iquan',
                    'purchase_products.tax as itax',
                    'purchase_products.total as isubtotal'
                )
                ->where('purchases.invoice_no','=',$purchase->invoice_no)
                ->get();

        $pdf = PDF::loadView('purchases.download',compact('purchase','supplier','invoice'));
        return $pdf->download('purchase_invoice.pdf');
       
    }
}
