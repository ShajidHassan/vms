<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    protected $table = "solds";

    public function vechicle(){
        return $this->belongsTo(Vehicle::class, "vechicle_id", "id");
    }
}
