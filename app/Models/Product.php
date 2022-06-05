<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'stock',
        'img_url',
        'seller_id'
    ];
    public static function getProduct($id)
    {
        return Product::find($id);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    
}
