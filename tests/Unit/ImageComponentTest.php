<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;

class ImageComponentTest extends TestCase
{
        /** @test */
        public function it_checks_image_and_properties_of_item()
        {
            // Creamos un item con un valor para 'image'
            $item = new Item();
            $item->image = (object)['url' => 'test-image.png'];
    
            // Aseguramos que la imagen existe y que la URL se genera correctamente
            $this->assertNotNull($item->image);
            $this->assertEquals('test-image.png', $item->image->url);
    
            // Verificamos que el Storage devuelve la URL correcta
            $url = Storage::url('public/'.$item->image->url);
            $this->assertStringContainsString('test-image.png', $url);
        }

}
