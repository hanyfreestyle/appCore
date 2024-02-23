<?php

namespace App\AppPlugin\Config\Branche;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SeederBranchTranslation extends Seeder{
    public function run(): void{
        BranchTranslation::unguard();
        $tablePath = public_path('db/config_branch_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
