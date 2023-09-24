<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shop;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_shop_can_be_created()
    {
        // premier etape: cheminement naturel de ce qui doit se passer
        // deuxieme etape: ecrire ce qu'on attend, avec les asserts functions.

        $response = $this->post('shops', [
            'title' => 'Nom de Boutique',
            'owner_id' => 1
        ]);

        $response = $this->post('shops', [
            'title' => 'boutique 3e32432',
            'owner_id' => 1
        ]);

        // $response->assertOk();
        $response->assertRedirect();


        $this->assertCount(2, Shop::all());
    }

    public function test_title_and_ownerId_can_not_be_empty(){

        // $this->withoutExceptionHandling();

        $response = $this->post('shops', [
            'title' => '',
            'owner_id' => null
        ]);

        $response->assertSessionhasErrors(['title', 'owner_id']);   
    }
}