<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // $this->call(ExpenseCategorySeeder::class);
        // $this->call(ExpenseSeeder::class);
        // $this->call(IncomeCategorySeeder::class);
        // $this->call(IncomeSeeder::class);
    }
}
