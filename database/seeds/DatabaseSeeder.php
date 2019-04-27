<?php

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
        factory(App\Models\Student::class, 5000)->create();
        //$this->call(UsersTableSeeder::class);
    }
}
