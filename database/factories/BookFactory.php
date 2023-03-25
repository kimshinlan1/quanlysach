<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(Book::class, function (Faker $faker) {
    return [
        //
            'ten' => $faker->sentence,
            'soluong' => rand(1,20),
            'nhaxuatban' => $faker->sentence,
            "danhmuc" => rand(1,5)
    ];
});