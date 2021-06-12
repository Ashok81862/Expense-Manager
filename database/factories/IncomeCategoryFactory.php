<?php

namespace Database\Factories;

use App\Models\IncomeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word(mt_rand(15,20), true);
        $user_id    = mt_rand(1,3);

        return [
            'name'  =>  $name,
            'user_id'   =>   $user_id
        ];
    }
}
