<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $user = User::factory()->create();
        $category = Category::factory()->create();
        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'name' => $this->faker->name,
            'description' => Str::random(10),
            'type' =>'year',
            'nbr_time' => 2,
        ];
    }
}
