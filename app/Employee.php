<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    public function getEmp(){
        $data=DB::table('employees')->join('companies','employees.company_id','=','companies.id')->paginate(3);
        return $data;
    }
}
