<?php

    //devolvemos el id del usuario autenticado
    function userID(){

        return auth()->user()->id;
    }

        //devolver numero formato moneda
    function money($number){
        return '$'.number_format($number,0,',',',');
    }


    //convertidor de numeros a letras
    function numeroLetras($number){

        return App\Models\NumerosEnLetras::convertir($number,'Pesos',false,'Centavos');

    }