<?php

namespace App\AppPlugin\AppPuzzle;

class AppModelTree {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ModelTree
    static function ModelTree(){
        $modelTree = [

            'ConfigApps'=>[
                'id'=>"ConfigApps",
                'info'=>"AppSetting.txt",
                'CopyFolder'=>"ConfigApps",
                'appFolder'=> "Config/",
                'app'=>'Apps',
//                'view'=>'ConfigApp',
//                'routeFolder'=> "config/",
//                'route'=>'appSetting.php',
//                'migrations'=> [
//                    '2019_12_14_000019_create_app_settings_table.php',
//                    '2019_12_14_000020_create_app_setting_translations_table.php',
//                    '2019_12_14_000021_create_app_menus_table.php',
//                    '2019_12_14_000022_create_app_menu_translations_table.php',
//                ],
//                'seeder'=> ['config_app_menu_translations.sql','config_app_menus.sql','config_app_setting_translations.sql','config_app_settings.sql'],
//                'adminLang'=> "admin/config/",
//                'adminLangFile'=> "apps.php",
            ],

//
//            'ConfigMeta'=>[
//                'id'=>"ConfigMeta",
//                'info'=>"ConfigMeta.txt",
//                'CopyFolder'=>"ConfigMeta",
//                'appFolder'=> "Config/",
//                'app'=>'Meta',
//                'view'=>'ConfigMeta',
//                'routeFolder'=> "config/",
//                'route'=>'configMeta.php',
//                'migrations'=> ['2019_12_14_000008_create_web_privacies_table.php','2019_12_14_000009_create_web_privacy_translations_table.php'],
//                'seeder'=> ['config_web_privacies.sql','config_web_privacy_translations.sql'],
//            ],
//
//            'ConfigPrivacy'=>[
//                'id'=>"ConfigPrivacy",
//                'info'=>"ConfigPrivacy.txt",
//                'CopyFolder'=>"ConfigPrivacy",
//                'appFolder'=> "Config/",
//                'app'=>'Privacy',
//                'view'=>'ConfigPrivacy',
//                'routeFolder'=> "config/",
//                'route'=>'webPrivacy.php',
//                'migrations'=> ['2019_12_14_000003_create_meta_tags_table.php','2019_12_14_000004_create_meta_tag_translations_table.php'],
//                'seeder'=> ['config_meta_tags.sql','config_setting_translations.sql'],
//            ],
//
//            'ConfigBranch'=>[
//                'id'=>"ConfigBranch",
//                'info'=>"ConfigBranch.txt",
//                'CopyFolder'=>"ConfigBranch",
//                'appFolder'=> "Config/",
//                'app'=>'Branche',
//                'view'=>'ConfigBranch',
//                'routeFolder'=> "config/",
//                'route'=>'Branch.php',
//                'migrations'=> ['2019_12_14_000017_create_branches_table.php','2019_12_14_000018_create_branch_translations_table.php'],
//                'seeder'=> ['config_branches.sql','config_branch_translations.sql'],
//                'adminLang'=> "admin/config/",
//                'adminLangFile'=> "branch.php",
//            ],
//
//            'DataCountry'=>[
//                'id'=>"DataCountry",
//                'info'=>"DataCountry.txt",
//                'CopyFolder'=>"DataCountry",
//                'appFolder'=> "Data/",
//                'app'=>'Country',
//                'view'=>'DataCountry',
//                'routeFolder'=> "data/",
//                'route'=>'country.php',
//                'migrations'=> ['2019_12_14_000014_create_countries_table.php','2019_12_14_000015_create_country_translations_table.php'],
//                'seeder'=> ['data_countries.sql','data_country_translations.sql'],
//                'adminLang'=> "admin/data/",
//                'adminLangFile'=> "country.php",
//            ],
//
//            'LeadsNewsLetter'=>[
//                'id'=>"LeadsNewsLetter",
//                'info'=>"LeadsNewsLetter.txt",
//                'CopyFolder'=>"LeadsNewsLetter",
//                'appFolder'=> "Leads/",
//                'app'=>'NewsLetter',
//                'view'=>'LeadsNewsLetter',
//                'routeFolder'=> "leads/",
//                'route'=>'newsLetter.php',
//                'migrations'=> ['2019_12_14_000010_create_news_letters_table.php'],
//                'seeder'=> ['leads_news_letters.sql'],
//                'adminLang'=> "admin/",
//                'adminLangFile'=> "newsletter.php",
//            ],
//
//
//            'LeadsContactUs'=>[
//                'id'=>"LeadsContactUs",
//                'info'=>"LeadsContactUs.txt",
//                'CopyFolder'=>"LeadsContactUs",
//                'appFolder'=> "Leads/",
//                'app'=>'ContactUs',
//                'view'=>'LeadsContactUs',
//                'routeFolder'=> "leads/",
//                'route'=>'contactUs.php',
//                'migrations'=> ['2019_12_14_000013_create_contact_us_forms_table.php'],
//                'seeder'=> ['leads_contact_us.sql'],
//                'adminLang'=> "admin/config/",
//                'adminLangFile'=> "leadForm.php",
//            ],


        ];

        return  $modelTree ;
    }

}