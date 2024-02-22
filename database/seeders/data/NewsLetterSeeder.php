<?php

namespace Database\Seeders\data;

use App\Models\data\NewsLetter;
use Illuminate\Database\Seeder;


class NewsLetterSeeder extends Seeder{

    public function run(): void{
        NewsLetter::factory(200)->create();
    }
}
