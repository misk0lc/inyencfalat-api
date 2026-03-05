<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MealTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_meal(): void
    {    
        //arrange
        $ingredients = Ingredient::factory()->count(3)->create();
        $meals = Meal::factory()->count(5)->create()->each(function ($meal) use ($ingredients) {
            $meal->ingredients()->attach(
                $ingredients->pluck('id')
            );
        });

        //act
        $response = $this->getJson('/api/meals');
        //assert
        $response->assertStatus(200);
        $this->assertGreaterThan(0, count($response->json()));
                 



        // $response = $this->get('/');

        // $response->assertStatus(200);
    }
}
