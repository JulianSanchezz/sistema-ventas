<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase{
        
    /**
     * Test that the categories route returns a successful response.
     *
     */
    public function test_categorias_returns_a_successful_response(): void{

        $response = $this -> get('/categorias');

        $response->assertStatus(200);
    }

    /**
     * Test that the Home route returns a successful response.
     *
     */
    public function test_inicio_returns_a_successful_response(): void{

        $response = $this -> get('/inicio');

        $response->assertStatus(200);
    }

    /**
     * Test that the Product route returns a successful response.
     *
     */
    public function test_productos_returns_a_successful_response(): void{

        $response = $this -> get('/productos');

        $response->assertStatus(200);
    }
}


