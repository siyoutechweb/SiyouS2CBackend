<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Shop extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

    
public function shopOwner()
{
    return $this->belongsTo(user::class);
}

public function chains() {
    return $this->hasMany(chain::class, 'store_id');
}


  // public function getShopsThroughOrder()
    // {
    //     return $this->hasManyThrough(User::class, Order::class, 'supplier_id', 'id', 'id', 'shop_owner_id');
    // }
    public function Category_id()
    {
        return $this->hasManyThrough( category::class, Product::class, 'category_id', 'id','id', 'category_id');
    }
}
