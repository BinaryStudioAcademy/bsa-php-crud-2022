<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'my_products';
    protected $primaryKey = 'id';
    protected $attributes = [
        'available' => false
    ];

    protected $fillable = ['name', 'price', 'seller_id'];
    protected $guarded = ['available'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

}
