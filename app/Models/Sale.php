<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    //relacion poliformica
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class)->withPivot(['qty','fecha']);//withpivot le pasamos las columnas que debe traer
    }

}
