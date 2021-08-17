<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\models\Tag::class, function (Faker $faker) {
    return [
        'name' => Str::random(5),
        'status' => 1
    ];
});
