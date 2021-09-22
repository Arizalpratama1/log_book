<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        //'id_kategori' => $faker->kategori,
        //'id_sub_kategori' => $faker->sub_kategori,
        //'judul' => $faker->judul,
        //'file' => $faker->file,
        //'tanggal' => $faker->tanggal,
    ];
});
