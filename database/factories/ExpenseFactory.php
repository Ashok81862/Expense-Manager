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
        $name   = $this->faker->word(mt_rand(1,3), true);
        $amount = mt_rand(100, 100000);
        $entry_date = $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now')->format("Y-m-d");
        $expense_category_id = mt_rand(1,ExpenseCategory::withoutGlobalScope('user')->count());
        $user_id    = ExpenseCategory::withoutGlobalScope('user')->find($expense_category_id)->user_id;


        return [
            'name'  =>$name,
            'amount'    =>  $amount,
            'entry_date'    =>  $entry_date,
            'expense_category_id'   =>  $expense_category_id,
            'user_id'   =>  $user_id
        ];
    }
}
