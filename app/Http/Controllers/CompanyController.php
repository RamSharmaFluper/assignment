<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Exception; 
use App\Company;
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
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
            'name'=>'required',
            'email'=>'required|email|unique:companies,email',
            // 'logo' => 'mimes:jpeg,png|dimensions:min_width=100,min_height=100|nullable', 
            //'website' => 'required'
        );
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect('add-company')
            ->withErrors($validator)
            ->withInput();
        }else{
            $compLogo = $request->logo;
            if(!empty($request->logo)){
                
                $path = $_FILES['logo']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if($ext == "jpg" || $ext == "jpeg" || $ext == "png"){
                    $compLogo = time().".". $request->logo->getClientOriginalName();
                        $move_file = $request->logo->move(
                        base_path().'/storage/app/public', $compLogo
                    );
                }else{
                    $session = session()->flash('logo-alert','Logo must be in image format like (jpg,jpeg,png)');
                    return redirect('add-company');
                }
            } 
            $comp = new Company;
            $comp->name = $request->name;
            $comp->email = $request->email;
            $comp->logo = $compLogo;
            $comp->website = $request->website;
            if($comp->save()){
                return redirect('home');
            } else {
                $session = session()->flash('warning','Something Wrong');
                return redirect('add-company');
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
        $comp = new Company();
        $comp_data = $comp->getCompanyById($id);
        return view('edit-company',compact('comp_data'));
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
            'name'=>'required',
            'email'=>'required',
        );
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect('edit-company/'.$id)
            ->withErrors($validator)
            ->withInput();
        }else{
            $comp = new Company();
            $company = $comp->find($id);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            if($company->save()) {
                return redirect('home');
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
        $comp = new Company();
        $file = $comp->find($id);
        Storage::delete('app/public/'.$file->name);
        $destroy = $comp->destroy($id);
        if($destroy){
            
            return $destroy;
        } else {
            return false;
        }
    }
}