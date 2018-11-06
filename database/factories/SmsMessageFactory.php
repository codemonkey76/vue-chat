<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\SmsMessage::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'sent' => mt_rand(0,1)==0,
        'number' => '614'.mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9),
        'created_at' => Carbon::now()->subHours(mt_rand(0,1000))
    ];
});
