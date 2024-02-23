<?php

namespace App\AppPlugin\Leads\NewsLetter;


use Illuminate\Database\Seeder;


class SeederNewsLetter extends Seeder{

    public function run(): void{
        NewsLetter::factory(200)->create();
    }
}
