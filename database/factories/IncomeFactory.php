<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name   = $this->faker->word(mt_rand(20,50), true);
        $amount = mt_rand(100, 100000);
        $entry_date = $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now')->format("Y-m-d");
        $income_category_id = mt_rand(1,20);
        $user_id    = mt_rand(1,3);



        return [
            'name'  =>$name,
            'amount'    =>  $amount,
            'entry_date'    =>  $entry_date,
            'income_category_id'   =>  $income_category_id,
            'user_id'   =>  $user_id
        ];
    }
}
