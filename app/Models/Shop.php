<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function users() {
        return $this->hasMany(chain::class);
    }

    
public function shopOwner()
{
    return $this->belongsTo(user::class);
}

}
