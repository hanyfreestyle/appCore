<?php

namespace Database\Seeders;

use App\AppPlugin\BlogPost\Seeder\BlogCategorySeeder;
use App\AppPlugin\BlogPost\Seeder\BlogCategoryTranslationSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogPhotoSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogPhotoTranslationSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogPivotSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogTranslationSeeder;
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
use App\AppPlugin\Faq\Seeder\FaqCategorySeeder;
use App\AppPlugin\Faq\Seeder\FaqCategoryTranslationSeeder;
use App\AppPlugin\Faq\Seeder\FaqPhotoSeeder;
use App\AppPlugin\Faq\Seeder\FaqPhotoTranslationSeeder;
use App\AppPlugin\Faq\Seeder\FaqPivotSeeder;
use App\AppPlugin\Faq\Seeder\FaqSeeder;
use App\AppPlugin\Faq\Seeder\FaqTranslationSeeder;
use App\AppPlugin\Leads\ContactUs\SeederContactUsForm;
use App\AppPlugin\Leads\NewsLetter\SeederNewsLetter;



use App\AppPlugin\Product\Seeder\BrandSeeder;
use App\AppPlugin\Product\Seeder\BrandTranslationSeeder;
use App\AppPlugin\Product\Seeder\CategoryProductSeeder;
use App\AppPlugin\Product\Seeder\CategorySeeder;
use App\AppPlugin\Product\Seeder\CategoryTranslationSeeder;
use App\AppPlugin\Product\Seeder\ProductAttributeOptionSeeder;
use App\AppPlugin\Product\Seeder\ProductAttributeSeeder;
use App\AppPlugin\Product\Seeder\ProductPhotoSeeder;
use App\AppPlugin\Product\Seeder\ProductSeeder;
use App\AppPlugin\Product\Seeder\ProductTranslationSeeder;
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

        $this->call(CategorySeeder::class);
        $this->call(CategoryTranslationSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(BrandTranslationSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductTranslationSeeder::class);
        $this->call(ProductPhotoSeeder::class);
        $this->call(CategoryProductSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(ProductAttributeOptionSeeder::class);


        $this->call(FaqCategorySeeder::class);
        $this->call(FaqCategoryTranslationSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(FaqTranslationSeeder::class);
        $this->call(FaqPivotSeeder::class);
        $this->call(FaqPhotoSeeder::class);
        $this->call(FaqPhotoTranslationSeeder::class);

        $this->call(BlogCategorySeeder::class);
        $this->call(BlogCategoryTranslationSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(BlogTranslationSeeder::class);
        $this->call(BlogPivotSeeder::class);
        $this->call(BlogPhotoSeeder::class);
        $this->call(BlogPhotoTranslationSeeder::class);


    }
}
