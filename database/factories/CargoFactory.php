<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cargo;
use Faker\Generator as Faker;

$factory->define(Cargo::class, function (Faker $faker) {
    return [
		'user_id' => 1,
		'tel' =>  $faker->tollFreePhoneNumber,
		'tel_second' =>  $faker->tollFreePhoneNumber,
		'site_url' =>  $faker->tollFreePhoneNumber,
		'skype' =>  $faker->tollFreePhoneNumber,
		'viber' =>  $faker->tollFreePhoneNumber,
		'whatsapp' =>  null,
		'email' =>  $faker->email,
		'load_date_from' =>  now(),
		'load_date_to' =>  now(),
		'load_from_0' =>  $faker->randomDigit,
		'load_from_1' =>  $faker->randomDigit,
		'load_from_2' =>  $faker->randomDigit,
		'load_from_3' =>  $faker->randomDigit,
		'load_from_4' =>  $faker->randomDigit,
		'load_from_5' =>  $faker->randomDigit,
		'load_from_6' =>  $faker->randomDigit,
		'unload_to_0' =>  $faker->randomDigit,
		'unload_to_1' =>  $faker->randomDigit,
		'unload_to_2' =>  $faker->randomDigit,
		'unload_to_3' =>  $faker->randomDigit,
		'unload_to_4' =>  $faker->randomDigit,
		'unload_to_5' =>  $faker->randomDigit,
		'unload_to_6' =>  $faker->randomDigit,
		'body_type' =>  $faker->randomDigit,
		'cargo_type' =>  $faker->randomDigit,
		'size_l' =>  $faker->randomDigit,
		'size_w' =>  $faker->randomDigit,
		'size_h' =>  $faker->randomDigit,
		'weight_max' =>  $faker->randomDigit,
		'capacity' =>  $faker->randomDigit,
		'quantity_transport' =>  $faker->randomDigit,
		'price_show' =>  $faker->randomDigit,
		'payment_type' =>  $faker->randomDigit,
		'nds' => 1,
		'price_amount' =>  $faker->randomDigit,
		'currency' => 1,
		'per_type' =>  1,
		'prepay' =>  $faker->randomDigit,
		'payment_time' => 1,
		'notice'=> $faker->sentence(2),
		'created_at'  =>  now(),
		'refresh_at' =>  now(),

    ];
});
