<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["id", "order_id", "locale", "firstname", "lastname", "address"];

}
