<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Facture;

$factory->define(Facture::class, function (Faker $faker) {
    return [
        'etat_facture' => 'Provisoire',
        'total_ht_articlesf' => $faker->randomDigit(),
        'remise_genf' => $faker->randomDigit(),
        'total_ht_apres_remise_genf' => $faker->randomDigit(),
        'tvaf' => $faker->randomDigit(),
        'total_facturef' => $faker->randomDigit(),
        'condition_reglf' => $faker->sentence(2),
        'mode_reglf' => $faker->sentence(2),
        'interet_reglf' => $faker->sentence(2),
        'code_bancf' => $faker->sentence(2),
        'text_introductionf' => $faker->text(100),
        'text_conclusionf' => $faker->text(100),
        'pied_pagef' => $faker->text(100),
        'devis' => 'euro',
        'client_id' => $faker->randomDigit(),
        'user_id' => '1'
    ];
});
