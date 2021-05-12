<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Client;
$factory->define(Client::class, function (Faker $faker) {
    return [
        //
        'nom_client' => $faker->sentence(2),
        'adresse_email_client' => 'khalid@gmail.com',
        'prenom_client' => $faker->sentence(2),
        'fonction_client' => $faker->sentence(1),
        'adresse_client' => $faker->text(50),
        'langue_client' => $faker->sentence(1),
        'codep_client' => $faker->numberBetween(1,10),
        'ville_client' => $faker->sentence(1),
        'site_client' => $faker->text(20),
        'tel_client' => $faker->numberBetween(1,20),
        'societe_client' => $faker->text(20),
        'note_client' => $faker->text(30),
        'id_user' => '3'
    ];
});
