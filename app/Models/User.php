<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject {
    use Authenticatable, Authorizable;
    use Traits\Roles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //Relationship between Admin and ShopOwner
    // public function AdminShopOwner()
    // {
    //     return $this->hasMany(User::class);
    // }
    // public function ShopOwnerAdmin()
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }


     //Relationship between ShopOwner and Manager
     public function ShopOwnerManager()
     {
         return $this->hasMany(User::class, 'shop_owner_id')->whereHas('role', function ($query) {
            $query->where('name', 'ShopManager')->distinct();
        });
     }
     public function ManagerShopOwner()
     {
         return $this->belongsTo(User::class, 'shop_owner_id');
     }

     //Relationship between ShopOwner and cachier
     public function ShopOwnerCachier()
     {
         return $this->hasMany(User::class, 'shop_owner_id')->whereHas('role', function ($query) {
            $query->where('name', 'cachier')->distinct();
        });
     }
     public function CachierShopOwner()
     {
         return $this->belongsTo(User::class,'shop_owner_id');
     }

     
public function shop()
{
    return $this->hasOne(Shop::class, 'shop_owner_id');
}

public function CachierChain()
{
    return $this->belongsTo(Chain::class,'shop_owner_id');
}

public function ManagerChain()
{
    return $this->hasOne(Chain::class,'manager_id');
}   

public function Products()
{
    return $this->hasMany(Product::class, 'shop_owner_id');
} 

    // public function getShopsThroughOrder()
    // {
    //     return $this->hasManyThrough(User::class, Order::class, 'supplier_id', 'id', 'id', 'shop_owner_id');
    // }

    public function Category_id()
    {
        return $this->hasManyThrough( category::class, Product::class, 'category_id', 'id','id', 'shop_owner_id');
    }

}
