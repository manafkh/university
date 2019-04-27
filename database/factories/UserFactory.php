<?php

use App\Models\Student;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Student::class, function (Faker $faker) {
    static $order = 1;
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'father_name' => $faker->name,
        'mother_name' => $faker->name,
        'phone' => $order++,
        'email' => $faker->unique()->safeEmail,
        //'email_verified_at' => now(),
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //'remember_token' => Str::random(10),
    ];
});
