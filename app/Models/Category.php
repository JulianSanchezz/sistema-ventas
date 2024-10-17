<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //establecemos la relacion entre productos y categorias
    public function products(){
        return $this->hasMany(Product::class);
    }

}
