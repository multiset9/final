<?php

use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 50)->create(['role_id' => 2])->each(function (\App\Models\User $user) {
            $user->organizations()->saveMany(factory(App\Models\Organization::class, 2)->make());
        });

        \App\Models\Organization::all()->each(function (\App\Models\Organization $organization) {
            $organization->vacancies()->saveMany(factory(App\Models\Vacancy::class, 2)->
            make(['creator_id' => $organization->creator_id]));
        });
        factory(App\Models\User::class, 50)->create(['role_id' => 1]);

        \App\Models\Vacancy::all()->
        each(function (\App\Models\Vacancy $vacancy) {
            $vacancy->order()->saveMany(factory(App\Models\Order::class, 2)->make());

        });
    }
}
