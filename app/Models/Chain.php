<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chain extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function shop()
    {
        return $this->belongsTo(shop::class, 'store_id');
    }

    
    public function Manager()
    {
        return $this->belongsTo(User::class,'id');
    }
    public function Cachiers()
    {
        return $this->hasMany(User::class, 'chain_id');
    }


}
