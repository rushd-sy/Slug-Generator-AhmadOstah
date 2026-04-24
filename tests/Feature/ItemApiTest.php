<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;

class ItemApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

     public function test_can_list_items(): void
    {
        Item::factory()->count(3)->create();

        $response = $this->getJson('/api/items');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_can_update_item_with_partial_payload(): void
    {
        $item = Item::factory()->create([
            'title' => 'Old title',
            'price' => 10,
            'stock_flag' => true,
            'image' => 'https://example.com/old-image.jpg',
            'description' => 'Old description',
        ]);

        $response = $this->putJson("/api/items/{$item->id}", [
            'title' => 'New title',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('title', 'New title')
            ->assertJsonPath('price', 10)
            ->assertJsonPath('stock_flag', 1)
            ->assertJsonPath('image', 'https://example.com/old-image.jpg')
            ->assertJsonPath('description', 'Old description');

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'title' => 'New title',
            'price' => 10,
            'stock_flag' => true,
            'image' => 'https://example.com/old-image.jpg',
            'description' => 'Old description',
        ]);
    }

}
