<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\category;

class Product extends Model
{

    use HasFactory , Translatable , SoftDeletes , HasEagerLimit;


    public $translatedAttributes = ['title', 'content' , 'smallDesc', 'price'];
    // protected $Fillable = [ "id", "image", "category_id", "created_at", "updated_at", "deleted_at"];
    protected $fillable = ['id', 'image', 'category_id', 'created_at', 'updated_at', 'deleted_at'];
    // protected $table ='products';

    public function category()
    {
       return $this->belongsTo(Category::class , 'category_id');
    }
}
