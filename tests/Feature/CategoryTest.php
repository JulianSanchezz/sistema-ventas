<?php

namespace Tests\Feature;

use Tests\TestCase;

class CategoryTest extends TestCase{
        
    /**
     * Test that the categories route returns a successful response.
     *
     */
    public function test_categorias_returns_a_successful_response(): void{

        $response = $this -> get('/categorias');

        $response->assertStatus(200);
    }


}
