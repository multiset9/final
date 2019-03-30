<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class)->create([
            'email' => 'name@mail.loc',
            'password' => Hash::make('123456'),
            'first_name' => 'name',
            'last_name' => 'surname',
            'country'=>'Ukr',
            'city'=>'Pol',
            'phone'=>'1233',
            'role_id'=>'1',

        ]);

       // factory(App\Models\User::class, 5)->create();
    }
}
