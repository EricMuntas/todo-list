<?php

namespace Database\Factories;

use App\Models\TODOList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TODOList>
 */
class TODOListFactory extends Factory
{
    protected $model = TODOList::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username'=>$this->faker->name(),
            'title'=>$this->faker->name(),
            'description'=>$this->faker->paragraph(),
           'checked'=>$this->faker->boolean(),
           'dueTo'=>$this->faker->date(),
           'category'=>$this->faker->randomElement(["Work", "Home", "Social", "Others"]),
           'priority'=>$this->faker->randomElement(["normal", "important"]),
        ];
    }
}
