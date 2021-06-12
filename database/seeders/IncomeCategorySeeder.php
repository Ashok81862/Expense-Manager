<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\IncomeCategory::factory(20)->create();
    }
}
