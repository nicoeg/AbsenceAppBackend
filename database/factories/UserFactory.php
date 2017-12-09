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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
        'untis_id' => rand(1000, 3200),
        'group_id' => function() {
            return factory(\App\Group::class)->create()->id;
        }
    ];
});

$factory->define(\App\Group::class, function(Faker $faker) {
    return [
        'untis_id' => rand(1000, 3200),
        'name' => $faker->slug
    ];
});

$factory->define(\App\Subject::class, function(Faker $faker) {
    return [
        'untis_id' => rand(1000, 3200),
        'name' => $faker->slug,
        'group_id' => function() {
            return factory(\App\Group::class)->create()->id;
        }
    ];
});

$factory->define(\App\Lesson::class, function(Faker $faker) {
    return [
        'untis_id' => rand(1000, 3200),
        'subject_id' => function() {
            return factory(\App\Subject::class)->create()->id;
        },
        'topic' => $faker->name,
    ];
});