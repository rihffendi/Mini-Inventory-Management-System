<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sub_category;
use App\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $subcategory = Sub_category::orderBy('id','desc')->get();

        $all = Sub_category::join('categories','categories.id','=','sub_categories.category_id')
        ->select('categories.name as categoryName',
            'sub_categories.name as subcategoryName',
            'sub_categories.status', 
            'sub_categories.id as subcategoriesId')
        ->get();
        // dd($all);

        return view('category.sub-categories.index')->with('all', $all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status','=',1)->get();
        return view('category.sub-categories.create')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory = new Sub_category();
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;
        $subcategory->details = $request->details;

        $subcategory->save();

        return redirect()->route('category.sub-categories.index')->with('success', 'Sub Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = Sub_category::where('sub_categories.id', $id)
        ->rightJoin('categories','categories.id','=','sub_categories.category_id')
        ->select('categories.name as categoryName',
            'sub_categories.name as subcategoryName',
            'sub_categories.status',
            'sub_categories.details')
        ->first();
        return view('category.sub-categories.show')->with('all', $all);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all = Sub_category::where('sub_categories.id', $id)
        ->rightJoin('categories','categories.id','=','sub_categories.category_id')
        ->select('categories.name as categoryName',
            'sub_categories.name as subcategoryName',
            'sub_categories.status',
            'sub_categories.details',
            'sub_categories.id',
            'sub_categories.category_id')
        ->first();
        $category = Category::all();
        return view('category.sub-categories.edit')->with([
            'all' => $all,
            'category' => $category
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
        $subcategory = Sub_category::find($id);
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;
        $subcategory->details = $request->details;

        $subcategory->save();

        return redirect()->route('category.sub-categories.index')->with('success', 'Updated successfully');
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
