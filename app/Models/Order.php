<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Order extends Model
{
    
    use HasFactory , Translatable , SoftDeletes , HasEagerLimit;
    public $translatedAttributes = ['firstname' , 'lastname', 'address',  'status'];

    // protected $Fillable = [ "id", "image", "category_id", "created_at", "updated_at", "deleted_at"];
    protected $fillable = ['id', 'user_id', 'subtotal', 'total', 'finalltotal', 'mobile', 'email', 'zipcode','support', 'updated_at', 'deleted_at'];
}
