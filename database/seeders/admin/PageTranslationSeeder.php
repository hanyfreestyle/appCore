<?php

namespace Database\Seeders\admin;

use App\Helpers\AdminHelper;
use App\Models\admin\Page;
use App\Models\admin\PageTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageTranslationSeeder extends Seeder
{

    public function run(): void
    {
        PageTranslation::unguard();
        $tablePath = public_path('db/page_translations.sql');
       // $tablePath = public_path('db/OldData/page_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

//        $OldData = PageTranslation::all();
//        foreach ($OldData as $updateData){
//            $updateData->name = $updateData->title;
//            $updateData->g_title = $updateData->title;
//            $updateData->title = null;
//            $updateData->des = $updateData->content;
//            $updateData->g_des =  AdminHelper::seoDesClean($updateData->content) ;
//            $updateData->content = null;
//            $updateData->save();
//        }

    }
}
