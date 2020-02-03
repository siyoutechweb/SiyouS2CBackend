<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function users() {
        return $this->hasMany(User::class, 'role_id');
    }

}
