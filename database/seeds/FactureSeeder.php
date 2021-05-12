<?php

use Illuminate\Database\Seeder;
use App\Facture;
class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Facture::class , 8)->create();
    }
}
