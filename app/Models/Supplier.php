<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model{
    use HasFactory, SoftDeletes;

    //Relationships
    //Products from this Supplier
    public function products(){
        return $this->hasMany(Product::class);
    }
}
