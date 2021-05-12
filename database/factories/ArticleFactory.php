<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Article;
$factory->define(Article::class, function (Faker $faker) {
    return [
        //
        'type_article' => $faker->randomElement($array = array ('service','Acompte','Heures','Jours','Produit')),
        'quantité_article' => $faker->randomDigit(),
        'prix_ht_article' => $faker->randomDigit(),
        'tva' => $faker->randomDigit(),
        'reduction_article' => $faker->randomDigit(),
        'total_ht_article' => $faker->randomDigit(),
        'total_ttc_article' => $faker->randomDigit(),
        'description_article' => $faker->text(100)
    ];
});
