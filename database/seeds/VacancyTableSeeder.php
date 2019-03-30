<?php

use Illuminate\Database\Seeder;

class VacancyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\Vacancy::class, 5)->create();
    }
}
