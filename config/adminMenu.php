<?php

$MenuView = [
    'Permissions'=>false,
    'Update'=>false,
    'Data'=>false,
//    'AdminLang'=>false,
    'WebLang'=>false,
//    'Setting'=>false,
    'LeadsFrom'=>false,
//    'AppSetting'=>false,
    'AppPuzzle'=>false,
];

return [
    'menu' => [
        [
            'view'=> IsMenuView($MenuView,"AppSetting"),
            'sel_routs'=>'App',
            'type'=>'many',
            'text'=> 'admin/configApp.app_menu',
            'icon'=>'fab fa-apple',
            'roleView'=>'AppSetting_view',
            'submenu'=>[
                [
                    'sel_routs'=> 'AppSetting',
                    'url'=> 'App.AppSetting.form',
                    'roleView'=>'AppSetting_view',
                    'text'=> 'admin/configApp.app_menu_config',
                    'icon'=>'fas fa-cogs'
                ],
                [
                    'sel_routs'=> 'AppPhotos',
                    'url'=> 'App.AppPhotos.form',
                    'roleView'=>'AppSetting_view',
                    'text'=> 'admin/configApp.app_menu_photos',
                    'icon'=>'fas fa-camera-retro'
                ],
                [
                    'sel_routs'=> 'AppMenu',
                    'url'=> 'App.AppMenu.index',
                    'roleView'=>'AppSetting_view',
                    'text'=> 'admin/configApp.app_menu_list',
                    'icon'=>'fas fa-list-ul'
                ],
                [
                    'sel_routs'=> 'AppProfile',
                    'url'=> 'App.AppProfile.form',
                    'roleView'=>'AppSetting_view',
                    'text'=> 'admin/configApp.app_menu_profile',
                    'icon'=>'fas fa-user-tie'
                ],
                [
                    'sel_routs'=> 'AppCart',
                    'url'=> 'App.AppCart.form',
                    'roleView'=>'AppSetting_view',
                    'text'=> 'admin/configApp.app_menu_cart',
                    'icon'=>'fas fa-shopping-cart'
                ],

            ],
        ], #App Setting
        [
            'view'=>  IsMenuView($MenuView,"LeadsFrom"),
            'sel_routs'=>'LeadsFrom',
            'type'=>'many',
            'text'=> 'admin/config/leadForm.app_menu',
            'icon'=>'fas fa-phone-volume',
            'roleView'=>'leads_view',
            'submenu'=>[
                ['roleView'=>'leads_view','text'=> 'admin/config/leadForm.app_menu_requst','url'=> 'LeadsFrom.Request.index','sel_routs'=> 'Request','icon'=>'fas fa-phone-square'],
                ['roleView'=>'leads_view','text'=> 'admin/config/leadForm.app_menu_meeting','url'=> 'LeadsFrom.Meeting.index','sel_routs'=> 'Meeting','icon'=>'fas fa-handshake'],
                ['roleView'=>'leads_view','text'=> 'admin/config/leadForm.app_menu_conatct','url'=> 'LeadsFrom.ContactUs.index','sel_routs'=> 'ContactUs','icon'=>'fas fa-mail-bulk'],
            ],
        ], #LeadsFrom
        [
            'view'=> IsMenuView($MenuView,"Permissions"),
            'sel_routs'=>'users',
            'type'=>'many',
            'text'=> 'admin/config/roles.menu_roles',
            'icon'=>'fas fa-unlock-alt',
            'roleView'=>'users_view',
            'submenu'=>[
                ['roleView'=>'users_view','text'=> 'admin/config/roles.menu_roles_users' ,'url'=> 'users.users.index', 'sel_routs'=> 'users','icon'=>'fas fa-users'],
                ['roleView'=>'roles_view','text'=> 'admin/config/roles.menu_roles_role','url'=>  'users.roles.index','sel_routs'=> 'roles','icon'=>'fas fa-traffic-light'],
                ['roleView'=>'roles_view','text'=> 'admin/config/roles.menu_roles_permissions' ,'url'=> 'users.permissions.index','sel_routs'=> 'permissions','icon'=>'fas fa-user-shield'],
            ],

        ], #Permissions
        [
            'view'=> IsMenuView($MenuView,"AdminLang"),
            'sel_routs'=>'adminlang',
            'type'=>'one',
            'text'=> 'admin.app_menu_lang_admin',
            'url'=> 'adminlang.index',
            'icon'=>'fas fa-language',
            'roleView'=>'adminlang_view',
        ], #Admin Lang
        [
            'view'=> IsMenuView($MenuView,"WebLang"),
            'sel_routs'=>'weblang',
            'type'=>'one',
            'text'=> 'admin.app_menu_lang_web',
            'url'=> 'weblang.index',
            'icon'=>'fas fa-language',
            'roleView'=>'weblang_view',
        ], #Web Lang
        [
            'view'=>  IsMenuView($MenuView,"Data"),
            'sel_routs'=>'data',
            'type'=>'many',
            'text'=> 'admin.app_menu_data',
            'icon'=>'fas fa-server',
            'roleView'=>'data_view',
            'submenu'=>[
                ['roleView'=>'country_view','text'=> 'admin/dataCountry.app_menu','url'=> 'data.Country.index','sel_routs'=> 'Country','icon'=>'fas fa-globe-americas'],
            ],
        ], #Data
        [
            'view'=>  IsMenuView($MenuView,"Setting"),
            'sel_routs'=>'config',
            'type'=>'many',
            'text'=> 'admin.app_menu_setting',
            'icon'=>'fas fa-cogs',
            'roleView'=>'config_view',
            'submenu'=>[
                ['roleView'=>'config_website','text'=> 'admin/config/webConfig.app_menu','url'=> 'config.web.index','sel_routs'=> 'web','icon'=>'fas fa-cog'],
                ['roleView'=>'config_meta_view','text'=> 'admin/configMeta.app_menu','url'=> 'config.Meta.index','sel_routs'=> 'Meta','icon'=>'fab fa-html5'],
                ['roleView'=>'config_defPhoto_view','text'=> 'admin/config/upFilter.app_menu_def_photo','url'=> 'config.defPhoto.index','sel_routs'=> 'defPhoto','icon'=>'fas fa-image'],
                ['roleView'=>'config_upFilter_view','text'=> 'admin/config/upFilter.app_menu','url'=> 'config.upFilter.index','sel_routs'=> 'upFilter','icon'=>'fas fa-filter'],
                ['roleView'=>'config_web_privacy','text'=> 'admin/configPrivacy.app_menu','url'=> 'config.WebPrivacy.index','sel_routs'=> 'WebPrivacy','icon'=>'fas fa-file-alt'],
                ['roleView'=>'config_newsletter','text'=> 'admin/leadsNewsLetter.app_menu','url'=> 'config.NewsLetter.index','sel_routs'=> 'NewsLetter','icon'=>'fas fa-mail-bulk'],
                ['roleView'=>'sitemap_view','text'=> 'admin/configSitemap.app_menu','url'=> 'config.SiteMap.index','sel_routs'=> 'SiteMap','icon'=>'fas fa-sitemap'],
                ['roleView'=>'config_branch','text'=> 'admin/configBranch.app_menu','url'=> 'config.Branch.index','sel_routs'=> 'Branch','icon'=>'fas fa-map-signs'],

            ],
        ], #Setting
        [
            'view'=> IsMenuView($MenuView,"AppPuzzle"),
            'sel_routs'=>'AppPuzzle',
            'type'=>'one',
            'text'=> 'AppPuzzle',
            'url'=> 'AppPuzzle.IndexModel',
            'icon'=>'fas fa-puzzle-piece',
            'roleView'=>'adminlang_view',
        ], #AppPuzzle


    ],

];

