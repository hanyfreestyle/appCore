<?php

$MenuView = [
//    'Permissions'=>false,
//    'Update'=>false,
//    'Broken'=>false,
//    'Data'=>false,
//    'AdminLang'=>false,
//    'WebLang'=>false,
//    'Setting'=>false,
//    'Developer'=>false,
//    'Amenity'=>false,
//    'Location'=>false,
//    'Pages'=>false,
//    'BlogPost'=>false,
//    'Project'=>false,
//    'ForSale'=>false,
//    'LeadsFrom'=>false,
];

 return [
    'menu' => [
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
        ],  #LeadsFrom
        [
            'view'=>IsMenuView($MenuView,"Project"),
            'sel_routs'=>'project',
            'type'=>'one',
            'text'=> 'admin/menu.project',
            'url'=> 'project.index',
            'icon'=>'fas fa-building',
            'roleView'=>'project_view',
        ],  #Project
        [
            'view'=>IsMenuView($MenuView,"ForSale"),
            'sel_routs'=>'ForSale',
            'type'=>'one',
            'text'=> 'admin/menu.unit',
            'url'=> 'ForSale.index',
            'icon'=>'fas fa-bath',
            'roleView'=>'forSale_view',
        ],  #ForSale
        [
            'view'=> IsMenuView($MenuView,"Amenity"),
            'sel_routs'=>'amenity',
            'type'=>'one',
            'text'=> 'admin/menu.amenity',
            'url'=> 'amenity.index',
            'icon'=>'fas fa-swimming-pool',
            'roleView'=>'amenity_view',
        ],  #Amenity
        [
            'view'=>IsMenuView($MenuView,"Location"),
            'sel_routs'=>'location',
            'type'=>'one',
            'text'=> 'admin/menu.location',
            'url'=> 'location.index',
            'icon'=>'fas fa-map-marker-alt',
            'roleView'=>'location_view',
        ],  #Location
        [
            'view'=>IsMenuView($MenuView,"Developer"),
            'sel_routs'=>'developer',
            'type'=>'one',
            'text'=> 'admin/menu.developer',
            'url'=> 'developer.index',
            'icon'=>'fas fa-truck-monster',
            'roleView'=>'developer_view',
        ],  #Developer
        [
            'view'=>IsMenuView($MenuView,"Pages"),
            'sel_routs'=>'pages',
            'type'=>'one',
            'text'=> 'admin/menu.pages',
            'url'=> 'pages.index',
            'icon'=>'fab fa-html5',
            'roleView'=>'pages_view',
        ],  #Pages
        [
            'view'=>IsMenuView($MenuView,"BlogPost"),
            'sel_routs'=>'Blog',
            'type'=>'many',
            'text'=> 'admin/menu.post',
            'icon'=>'fas fa-rss-square',
            'roleView'=>'post_view',
            'submenu'=>[
                [
                    'sel_routs'=> 'category',
                    'url'=> 'Blog.category.index',
                    'roleView'=>'post_view',
                    'text'=> 'admin/menu.category',
                    'icon'=>'fas fa-sitemap'
                ],
                [
                    'sel_routs'=> 'post',
                    'url'=> 'Blog.post.index',
                    'roleView'=>'post_view',
                    'text'=> 'admin/menu.post',
                    'icon'=>'fab fa-blogger-b'
                ],

            ],
        ],  #BlogPost
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

        ],  #Permissions
        [
            'view'=> IsMenuView($MenuView,"AdminLang"),
            'sel_routs'=>'adminlang',
            'type'=>'one',
            'text'=> 'admin/config/core.app_menu_lang_admin',
            'url'=> 'adminlang.index',
            'icon'=>'fas fa-language',
            'roleView'=>'adminlang_view',
        ],  #Admin Lang
        [
            'view'=> IsMenuView($MenuView,"WebLang"),
            'sel_routs'=>'weblang',
            'type'=>'one',
            'text'=> 'admin/config/core.app_menu_lang_web',
            'url'=> 'weblang.index',
            'icon'=>'fas fa-language',
            'roleView'=>'weblang_view',
        ],  #Web Lang
        [
            'view'=>  IsMenuView($MenuView,"Data"),
            'sel_routs'=>'data',
            'type'=>'many',
            'text'=> 'admin/config/core.app_menu_data',
            'icon'=>'fas fa-server',
            'roleView'=>'data_view',
            'submenu'=>[
                ['roleView'=>'country_view','text'=> 'admin/data/country.menu','url'=> 'data.Country.index','sel_routs'=> 'Country','icon'=>'fas fa-globe-americas'],
            ],
        ],  #Data
        [
            'view'=>  IsMenuView($MenuView,"Setting"),
            'sel_routs'=>'config',
            'type'=>'many',
            'text'=> 'admin/config/core.app_menu_setting',
            'icon'=>'fas fa-cogs',
            'roleView'=>'config_view',
            'submenu'=>[
                ['roleView'=>'config_website','text'=> 'admin/config/webConfig.app_menu','url'=> 'config.web.index','sel_routs'=> 'web','icon'=>'fas fa-cog'],
                ['roleView'=>'config_meta_view','text'=> 'admin/config/core.app_menu_meta_tags','url'=> 'config.Meta.index','sel_routs'=> 'Meta','icon'=>'fab fa-html5'],
                ['roleView'=>'config_defPhoto_view','text'=> 'admin/config/upFilter.app_menu_def_photo','url'=> 'config.defPhoto.index','sel_routs'=> 'defPhoto','icon'=>'fas fa-image'],
                ['roleView'=>'config_upFilter_view','text'=> 'admin/config/upFilter.app_menu','url'=> 'config.upFilter.index','sel_routs'=> 'upFilter','icon'=>'fas fa-filter'],
                ['roleView'=>'config_newsletter','text'=> 'admin/newsletter.menu','url'=> 'config.NewsLetter.index','sel_routs'=> 'NewsLetter','icon'=>'fas fa-mail-bulk'],
                ['roleView'=>'config_website','text'=> 'admin/config/cash.app_menu','url'=> 'config.update.UpdateData','sel_routs'=> 'update','icon'=>'fas fa-database'],
                ['roleView'=>'sitemap_view','text'=> 'admin/config/sitemap.app_menu','url'=> 'config.SiteMap.index','sel_routs'=> 'SiteMap','icon'=>'fas fa-sitemap'],
            ],
        ],  #Setting

    ],

];
