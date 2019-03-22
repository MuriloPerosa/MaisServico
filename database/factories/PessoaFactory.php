<?php

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

$factory->define(App\Pessoa::class, function (Faker $faker) {
    return [
        'cpf' =>  $faker->unique()->randomNumber($nbDigits = 9),
        'rg' =>  $faker->unique()->randomNumber($nbDigits = 8),
        'telefone' =>  $faker->unique()->randomNumber($nbDigits = 8),
        'celular' =>  $faker->unique()->randomNumber($nbDigits = 8),
        'data_nascimento' => '1998-06-05',
        'cidade_id' => 7,
        'user_id'=> 12,
    ];
});
