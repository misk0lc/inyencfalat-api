<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingredient;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = Ingredient::all();
        Meal::factory()->count(5)->create()->each(function ($meal) use ($ingredients) {
            $meal->ingredients()->attach(
                $ingredients->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
