<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Exception; 
use App\Employee;
use App\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = new Employee;
        $employees = $emp->getEmp();
        return view('employees',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comp = new Company();
        $companies = $comp->companies();
        return view('add-employee',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = array(
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:employees,email',
            'phone' => 'required|regex:/(91)[0-9]{9}/',
            'company_id' => 'required|exists:companies,id',
        );
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect('add-employee')
            ->withErrors($validator)
            ->withInput();
        }else{
            $emp = new Employee;
            $emp->first_name = $request->first_name;
            $emp->last_name = $request->last_name;
            $emp->email = $request->email;
            $emp->phone = $request->phone;
            $emp->company_id = $request->company_id;
            if($emp->save()){
                return redirect('employees');
            } else {
                $session = session()->flash('warning','Something Wrong');
                return redirect('add-employee');
            }
        }
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
        $emp = new Employee();
        $comp = new Company();
        $employees = $emp->find($id);
        $companies = $comp->companies();
        return view('edit-emp',compact('employees','companies'));
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
        $validation = array(
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => 'unique:employees,email,'.$id,
            'phone' => 'required|regex:/(91)[0-9]{9}/',
            'company_id' => 'required|exists:companies,id',
        );
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect('edit-employee/'.$id)
            ->withErrors($validator)
            ->withInput();
        }else{
            $emp = new Employee;
            $employee = $emp->find($id);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company_id;

           
            if($employee->save()) {
                return redirect('employees');
            } else {
                dd('Some thing Wrong');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = new Employee ();
        $destroy = $employee->destroy($id);
        if($destroy){
            return $destroy;
        } else {
            return false;
        }
    }
}
