<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model{
    use HasFactory, SoftDeletes;

    //Relationships
    //This Product's Supplier
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    //Sales where this product was part of
    public function sales(){
        return $this->belongsToMany(Sale::class)->withPivot('sell_price', 'sold_amount');
    }
}
