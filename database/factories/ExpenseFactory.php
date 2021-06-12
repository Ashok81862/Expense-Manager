<?php

namespace Database\Factories;

use App\Models\Expense;

use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

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
        $expense_category_id = mt_rand(1,20);



        return [
            'name'  =>$name,
            'amount'    =>  $amount,
            'entry_date'    =>  $entry_date,
            'expense_category_id'   =>  $expense_category_id,
        ];
    }
}
