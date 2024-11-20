<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total',       // Campo de la tabla
        'pago',        // Campo de la tabla
        'fecha',       // Campo de la tabla
        'user_id',     // Relación con User
        'client_id',   // Relación con Client
        'estadoVenta', // Campo para baja lógica
    ];

    //relacion poliformica
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class)->withPivot(['qty','fecha']);//withpivot le pasamos las columnas que debe traer
    }

}
