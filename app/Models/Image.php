<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    
    protected $fillable = ['url', 'imageable_type', 'imageable_id'];

    public function imageable(){

        return $this->morphTo(); //establecemos que el modelo image va trabajar con relaciones poliformicas segun laravel doc
    }

}
