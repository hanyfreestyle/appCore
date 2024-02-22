<?php

namespace Database\Seeders;


use Database\Seeders\admin\AmenitySeeder;
use Database\Seeders\admin\AmenityTranslationSeeder;
use Database\Seeders\admin\CategorySeeder;
use Database\Seeders\admin\CategoryTranslationSeeder;
use Database\Seeders\admin\DeveloperPhotoSeeder;
use Database\Seeders\admin\DeveloperSeeder;
use Database\Seeders\admin\DeveloperTranslationSeeder;
use Database\Seeders\admin\ListingPhotoSeeder;
use Database\Seeders\admin\ListingSeeder;
use Database\Seeders\admin\ListingTranslationSeeder;
use Database\Seeders\admin\LocationSeeder;
use Database\Seeders\admin\LocationTranslationSeeder;
use Database\Seeders\admin\PageSeeder;
use Database\Seeders\admin\PageTranslationSeeder;
use Database\Seeders\admin\PostPhotoSeeder;
use Database\Seeders\admin\PostSeeder;
use Database\Seeders\admin\PostTranslationSeeder;
use Database\Seeders\admin\QuestionSeeder;
use Database\Seeders\admin\QuestionTranslationSeeder;
use Database\Seeders\admin\UpdateCountSeeder;
use Database\Seeders\data\ContactUsFormSeeder;
use Database\Seeders\data\CountrySeeder;
use Database\Seeders\data\CountryTranslationSeeder;
use Database\Seeders\data\NewsLetterSeeder;
use Database\Seeders\roles\AdminUserSeeder;
use Database\Seeders\roles\PermissionSeeder;
use Database\Seeders\roles\RoleSeeder;
use Database\Seeders\config\DefPhotoSeeder;
use Database\Seeders\config\MetaTagSeeder;
use Database\Seeders\config\MetaTagTranslationsTableSeeder;
use Database\Seeders\config\SettingsTableSeeder;
use Database\Seeders\config\SettingsTranslationsTableSeeder;
use Database\Seeders\config\UploadFilterSeeder;
use Database\Seeders\config\UploadFilterSizeSeeder;
use Database\Seeders\config\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(SettingsTableSeeder::class);
        $this->call(SettingsTranslationsTableSeeder::class);
        $this->call(MetaTagSeeder::class);
        $this->call(MetaTagTranslationsTableSeeder::class);
        $this->call(DefPhotoSeeder::class);
        $this->call(UploadFilterSeeder::class);
        $this->call(UploadFilterSizeSeeder::class);

        $this->call(CountrySeeder::class);
        $this->call(CountryTranslationSeeder::class);
        $this->call(NewsLetterSeeder::class);
        $this->call(ContactUsFormSeeder::class);

//        $this->call(AmenitySeeder::class);
//        $this->call(AmenityTranslationSeeder::class);
//
//        $this->call(CategorySeeder::class);
//        $this->call(CategoryTranslationSeeder::class);
//        $this->call(LocationSeeder::class);
//        $this->call(LocationTranslationSeeder::class);
//
//        $this->call(DeveloperSeeder::class);
//        $this->call(DeveloperTranslationSeeder::class);
//        $this->call(DeveloperPhotoSeeder::class);
//
//        $this->call(ListingSeeder::class);
//        $this->call(ListingTranslationSeeder::class);
//        $this->call(ListingPhotoSeeder::class);
//        $this->call(QuestionSeeder::class);
//        $this->call(QuestionTranslationSeeder::class);
//
//        $this->call(PostSeeder::class);
//        $this->call(PostTranslationSeeder::class);
//        $this->call(PostPhotoSeeder::class);
//
//        $this->call(PageSeeder::class);
//        $this->call(PageTranslationSeeder::class);
//        $this->call(UpdateCountSeeder::class);


    }
}
