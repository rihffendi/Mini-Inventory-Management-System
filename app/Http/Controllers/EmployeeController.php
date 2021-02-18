<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::orderBy('id','desc')->get();
        return view('people.employees.index')->with('employee', $employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->national_id = $request->national_id;
        $employee->age = $request->age;
        $employee->gender = $request->gender;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $employee->status = $request->status;

        $employee->save();

        return redirect()->route('people.employees.index')->with('success','Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        return view('people.employees.show')->with('employee', $employee);
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
        $employee = Employee::find($id);
        // dd($supplier);

        return view('people.employees.edit')->with('employee', $employee);
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
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->national_id = $request->national_id;
        $employee->age = $request->age;
        $employee->gender = $request->gender;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $employee->status = $request->status;

        $employee->save();

        return redirect()->route('people.employees.index')->with('success', 'Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $employee = Employee::find($request->id)->delete();
        return redirect()->route('people.employees.index')->with('delete','Deleted Successfully');
    }
}
