<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["id", "product_id", "locale", "title", "content", "smallDesc", "price"];
}
