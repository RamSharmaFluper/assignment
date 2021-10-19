<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name','email', 'logo', 'website'
    ];

    public function getCompanyById($id){
        return self::find($id);
    }
    
    public function companies(){
        return self::all();
    }

    

}
