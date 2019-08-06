<?php

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

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2,4),
        'image' => 'http://via.placeholder.com/350x250',
        'description' => $faker->paragraphs(rand(1, 1), true),
        'price' => $faker->numberBetween(100,1000),
    ];

});

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'=> 'Sidney',
        'surname'=> 'de Sousa',
        'email'=> 'fullstack@example.com',
        'street_address'=> '153 Monte Amiata, Williams rd',
        'address_type'=> 'residential',
        'suburb'=> 'Parow',
        'city'=> 'Cape Town',
        'postal_code'=> '7500',
        'password'=> bcrypt('secret'),
        'created_at' => now()
    ];

});