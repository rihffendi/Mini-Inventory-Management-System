<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
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
        // dd($request->file('company_logo'));
        $user = User::find($id);
        if(!empty($request->file('company_logo'))){
            $image = $request->file('company_logo');
            $imagename =$image->getClientOriginalName();
            $path = public_path('/images/company_logo/');
            $check =$path.$imagename;

            if(File::exists($check)){
                    return redirect()->route('profile.index')->with('delete','Company Logo already exists');
                }
                else
                {   
                    $delete = public_path($user->company_logo);
                    File::delete($delete);
                    $image->move($path, $imagename);
                    $user->company_logo = '/images/company_logo/'.$imagename;
                }
        }

         if(!empty($request->file('profile_photo'))){
            $image = $request->file('profile_photo');
            $imagename =$image->getClientOriginalName();
            $path = public_path('/images/profile_photo/');
            $check =$path.$imagename;

            if(File::exists($check)){
                    return redirect()->route('profile.index')->with('delete','Profile Photo already exists');
                }
                else
                {   
                    $delete = public_path($user->profile_photo);
                    File::delete($delete);
                    $image->move($path, $imagename);
                    $user->profile_photo = '/images/profile_photo/'.$imagename;
                }
        }

        $user->name = $request->user_name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->contact = $request->company_contact;
        $user->address = $request->company_address;
        $user->company_name= $request->company_name;

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile has been updated');

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
