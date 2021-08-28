<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $table = "purchases";

    public function vechicle(){
        return $this->belongsTo(Vehicle::class, "vechicle_id", "id");
    }
}
