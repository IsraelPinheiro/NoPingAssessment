<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'closed' => 'boolean',
    ];

    //Relationships
    //Sales' Customer
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    //Sale's products
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('sell_price', 'units');
    }
}
