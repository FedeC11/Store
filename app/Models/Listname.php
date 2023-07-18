<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listname extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function items(){
        return $this->belongsToMany(Item::class,'item_listnames');
    }
}
