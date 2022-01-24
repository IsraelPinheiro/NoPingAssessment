<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model{
    use HasFactory, SoftDeletes;

    //Relationships
    //Customer's Purchases
    public function purchases(){
        return $this->hasMany(Sale::class);
    }
}
