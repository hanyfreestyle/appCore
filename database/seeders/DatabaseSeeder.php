<?php

namespace Database\Seeders;

use App\AppPlugin\Config\Meta\SeederMetaTag;
use App\AppPlugin\Config\Meta\SeederMetaTagTranslationsTable;
use App\AppPlugin\Data\Country\SeederCountry;
use App\AppPlugin\Data\Country\SeederCountryTranslation;

use Database\Seeders\data\ContactUsFormSeeder;
use Database\Seeders\data\NewsLetterSeeder;
use Database\Seeders\roles\AdminUserSeeder;
use Database\Seeders\roles\PermissionSeeder;
use Database\Seeders\roles\RoleSeeder;
use Database\Seeders\config\DefPhotoSeeder;
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
        $this->call(SeederMetaTag::class);
        $this->call(SeederMetaTagTranslationsTable::class);
        $this->call(DefPhotoSeeder::class);
        $this->call(UploadFilterSeeder::class);
        $this->call(UploadFilterSizeSeeder::class);

        $this->call(SeederCountry::class);
        $this->call(SeederCountryTranslation::class);
        $this->call(NewsLetterSeeder::class);
        $this->call(ContactUsFormSeeder::class);


    }
}
