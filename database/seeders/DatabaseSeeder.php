<?php

namespace Database\Seeders;

use App\AppPlugin\BlogPost\Seeder\BlogCategorySeeder;
use App\AppPlugin\BlogPost\Seeder\BlogPhotoSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogPivotSeeder;
use App\AppPlugin\BlogPost\Seeder\BlogSeeder;

use App\AppPlugin\Config\Apps\SeederAppMenu;
use App\AppPlugin\Config\Apps\SeederAppSetting;
use App\AppPlugin\Config\Branche\SeederBranch;

use App\AppPlugin\Config\Meta\SeederMetaTag;
use App\AppPlugin\Config\Privacy\SeederWebPrivacy;
use App\AppPlugin\Data\Country\SeederCountry;
use App\AppPlugin\Leads\ContactUs\SeederContactUsForm;
use App\AppPlugin\Leads\NewsLetter\SeederNewsLetter;


use App\AppPlugin\Faq\Seeder\FaqCategorySeeder;
use App\AppPlugin\Faq\Seeder\FaqPhotoSeeder;
use App\AppPlugin\Faq\Seeder\FaqPivotSeeder;
use App\AppPlugin\Faq\Seeder\FaqSeeder;


use App\AppPlugin\Product\Seeder\BrandSeeder;
use App\AppPlugin\Product\Seeder\CategoryProductSeeder;
use App\AppPlugin\Product\Seeder\CategorySeeder;

use App\AppPlugin\Product\Seeder\ProductAttributeSeeder;
use App\AppPlugin\Product\Seeder\ProductAttributeValueSeeder;
use App\AppPlugin\Product\Seeder\ProductPhotoSeeder;
use App\AppPlugin\Product\Seeder\ProductSeeder;
use Database\Seeders\roles\AdminUserSeeder;
use Database\Seeders\roles\PermissionSeeder;
use Database\Seeders\roles\RoleSeeder;
use Database\Seeders\config\DefPhotoSeeder;
use Database\Seeders\config\SettingsTableSeeder;

use Database\Seeders\config\UploadFilterSeeder;
use Database\Seeders\config\UploadFilterSizeSeeder;
use Database\Seeders\config\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run(): void {

        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(SettingsTableSeeder::class);
        $this->call(SeederMetaTag::class);
        $this->call(DefPhotoSeeder::class);
        $this->call(UploadFilterSeeder::class);
        $this->call(UploadFilterSizeSeeder::class);

//        $this->call(SeederWebPrivacy::class);
//        $this->call(SeederCountry::class);
//        $this->call(SeederNewsLetter::class);
//        $this->call(SeederContactUsForm::class);
//        $this->call(SeederBranch::class);
//
//        $this->call(SeederAppSetting::class);
//        $this->call(SeederAppMenu::class);
//
//        $this->call(FaqCategorySeeder::class);
//        $this->call(FaqSeeder::class);
//        $this->call(FaqPivotSeeder::class);
//        $this->call(FaqPhotoSeeder::class);
//
//        $this->call(BlogCategorySeeder::class);
//        $this->call(BlogSeeder::class);
//        $this->call(BlogPivotSeeder::class);
//        $this->call(BlogPhotoSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
//        $this->call(ProductAttributeSeeder::class);
//        $this->call(ProductAttributeValueSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CategoryProductSeeder::class);
//        $this->call(ProductPhotoSeeder::class);


    }
}
