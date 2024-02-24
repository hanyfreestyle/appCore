<?php

namespace Database\Seeders;

use App\AppPlugin\Config\Apps\SeederAppMenu;
use App\AppPlugin\Config\Apps\SeederAppMenuTranslation;
use App\AppPlugin\Config\Apps\SeederAppSetting;
use App\AppPlugin\Config\Apps\SeederAppSettingTranslation;
use App\AppPlugin\Config\Branche\SeederBranch;
use App\AppPlugin\Config\Branche\SeederBranchTranslation;
use App\AppPlugin\Config\Meta\SeederMetaTag;
use App\AppPlugin\Config\Meta\SeederMetaTagTranslationsTable;
use App\AppPlugin\Config\Privacy\SeederWebPrivacy;
use App\AppPlugin\Config\Privacy\SeederWebPrivacyTranslation;
use App\AppPlugin\Data\Country\SeederCountry;
use App\AppPlugin\Data\Country\SeederCountryTranslation;
use App\AppPlugin\Leads\ContactUs\SeederContactUsForm;
use App\AppPlugin\Leads\NewsLetter\SeederNewsLetter;



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
        $this->call(SeederWebPrivacy::class);
        $this->call(SeederWebPrivacyTranslation::class);
        $this->call(SeederCountry::class);
        $this->call(SeederCountryTranslation::class);
        $this->call(SeederNewsLetter::class);
        $this->call(SeederContactUsForm::class);
        $this->call(SeederBranch::class);
        $this->call(SeederBranchTranslation::class);

        $this->call(SeederAppSetting::class);
        $this->call(SeederAppSettingTranslation::class);
        $this->call(SeederAppMenu::class);
        $this->call(SeederAppMenuTranslation::class);

    }
}
