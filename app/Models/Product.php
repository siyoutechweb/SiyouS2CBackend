<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use softdelete;
    
    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function shopOwner() {
        return $this->belongsTo(User::class, 'shop_owner_id');
    }

}
