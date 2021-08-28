<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    public function purchasses(){
        return $this->hasMany(Purchases::class,"vechicle_id","id");
    }

    public function sales(){
        return $this->hasMany(Sold::class,"vechicle_id","id");
    }

    public function category(){
        return $this->belongsTo(Category::class,"category_id","id");
    }
    
}
