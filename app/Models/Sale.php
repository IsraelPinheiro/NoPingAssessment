<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model{
    use HasFactory, SoftDeletes;

    //Relationships
    //Sales' Customer
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
