<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Employee::all();
        return view('employees',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emp = new Employee();
        $emp->employee_name = $request->get('name');
        $emp->email = $request->get('email');
        $emp->phone = $request->get('phone');
        $emp->dob = date('Y-m-d',strtotime($request->get('dob')));
        $success = $emp->save();
        Session::flash('message','<div class="alert alert-success" role="alert">
        New Employee has been added successfully
      </div>');
        return response()->json($success);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $employee = Employee::find($request->get('eid'));
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $emp = Employee::find($request->get('uid'));
        $emp->employee_name = $request->get('name');
        $emp->email = $request->get('email');
        $emp->phone = $request->get('phone');
        $emp->dob = date('Y-m-d',strtotime($request->get('dob')));
        $success = $emp->save();
        Session::flash('message','<div class="alert alert-success" role="alert">
        New Employee has been updated successfully
      </div>');
        return response()->json($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $success = Employee::find($request->get('eid'))->delete();
        Session::flash('message','<div class="alert alert-success" role="alert">
        Employee has been removed successfully
      </div>');
        return response()->json($success);
    }
}
