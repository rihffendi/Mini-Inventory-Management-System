<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Supplier;
use App\Sub_category;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();  
        return view('products.index')->with('product',$product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category = Category::where('status','=',1)->get();
        return view('products.create')->with([
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        if($request->cat_id > 0){
        $subcat = Sub_category::where('category_id','=',$request->cat_id)->where('status','=',1)->get();
        return response()->json([
          'subcat' => $subcat
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
        $category = Category::where('id','=',$request->category)->first();
        // dd($category);
        $product = new Product();
        $product->name = $request->name;
        $product->category_name = $category->name;

        if($request->subcategory > 0){
            $subcategory = Sub_category::where('id','=',$request->subcategory)->first();
            $product->sub_category_name = $subcategory->name;
        }
       
        $product->product_code = $request->product_code;
        $product->alert_quantity = $request->alert_quantity;
        $product->product_cost = $request->product_cost;
        $product->product_price = $request->product_price;
        $product->tax = $request->tax;
        $product->product_details = $request->product_details;

        $product->save();

        return redirect()->route('products.index')->with('success','Product Created Successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $subcategory = Sub_category::all();
        return view('products.edit')->with([
            'product' => $product,
            'category' => $category,
            'subcategory' => $subcategory
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
        
        $product = Product::find($id);
        $product->name = $request->name;

        $category = Category::where('id','=',$request->category)->first();
        $product->category_name = $category->name;

        if($request->subcategory > 0){
            $subcategory = Sub_category::where('id','=',$request->subcategory)->first();
            $product->sub_category_name = $subcategory->name;
        }
        else{
            $product->sub_category_name = $request->subcategory;
        }
       
        $product->product_code = $request->product_code;
        $product->alert_quantity = $request->alert_quantity;
        $product->product_cost = $request->product_cost;
        $product->product_price = $request->product_price;
        $product->tax = $request->tax;
        $product->product_details = $request->product_details;

        $product->save();

        return redirect()->route('products.index')->with('success','Updated Successfully'); 
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
