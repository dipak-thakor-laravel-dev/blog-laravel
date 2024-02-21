<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    // use DatabaseTransactions;

    public function test_product_create()
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Tesrt',
            'detail' => 'ewrwrwerwer',
        ]);
        // check posts count
        $this->assertEquals(1, Product::count());
    }

    public function test_product_show()
    {
        $product = $this->post(route('products.store'), [
            'name' => 'Tesrt',
            'detail' => 'ewrwrwerwer',
        ]);
        $product = Product::first();

        $this->assertEquals(1, $product->count());
    }
    public function test_product_deletion()
    {
        $product = $this->post(route('products.store'), [
            'name' => 'Tesrt',
            'detail' => 'ewrwrwerwer',
        ]);
        $product = Product::first();
        $response = $this->delete(route('products.destroy', $product->id));

        $response->assertStatus(302);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
