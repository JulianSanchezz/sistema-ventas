<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase{
        
    /**
     * Test that the Home route returns a successful response.
     *
     */
    public function test_inicio_returns_a_successful_response(): void{

        $response = $this -> get('/inicio');

        $response->assertStatus(200);

    }

}