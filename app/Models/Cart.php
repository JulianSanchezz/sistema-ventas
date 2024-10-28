<?php

namespace App\Models;

use App\Models\Product;

class Cart 
{
    // Agregar producto al carrito
    public static function add(Product $product)
    {
        if (!$product) {
            throw new \Exception('El producto no existe.');
        }

        // Agregar producto al carrito
        \Cart::session(userID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->precio_venta,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));
    }


    // Método para obtener el contenido del carrito de compras
     public static function getCart()
     {
         $userId = auth()->id(); // Obtener el ID del usuario autenticado

    // Obtener el contenido del carrito de la sesión del usuario y ordenarlo
         $cart = \Cart::session($userId)->getContent();
         return $cart->sort();
     }

     public static function getTotal(){
        return \Cart::session(userID())->getTotal();
         
    }

    //decrementar cantidad del carrito
    public static function decrement($id){
         \Cart::session(userID())->update($id,[
            'quantity' => -1
        ]);
         
    }

    //incrementar cantidad
    public static function increment($id){
         \Cart::session(userID())->update($id,[
            'quantity' => +1
        ]);
    }

    //eliminar item
    public static function removeItem($id){
         \Cart::session(userID())->remove($id);
    }


    //limpiar carrito
    public static function clear(){
        \Cart::session(userID())->clear();
   }


   //Total Articulos
   public static function totalArticulos(){
    return \Cart::session(userID())->getTotalQuantity();
}


}
