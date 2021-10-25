<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comp = new Company();
        $companies = $comp::paginate(3);
        return view('home',compact('companies'));
    }    
    
}
