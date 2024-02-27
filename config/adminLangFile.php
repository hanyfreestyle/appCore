<?php
return [
    'adminFile' => [
        'admin'=> ['id'=> 'admin' , 'group'=>null ,'file_name'=> 'admin', 'name_en'=> "Admin Core" ,'name_ar'=> "لوحة التحكم " ],
        'webConfig'=> ['id'=> 'webConfig' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'webConfig','name'=>'web Config','name_ar'=>'اعدادات الموقع' ],
        'upFilter'=> ['id'=> 'upFilter' , 'group'=>'admin','sub_dir'=> 'config','file_name'=> 'upFilter','name'=>'Photo Filter','name_ar'=>'فلاتر الصور' ],
        'settings'=> ['id'=> 'settings' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'settings','name'=>'Settings','name_ar'=>'اعدادات الاقسام' ],
        'dataTable'=> ['id'=> 'dataTable' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'dataTable','name'=>'dataTable','name_ar'=>'dataTable' ],
        'roles'=> ['id'=> 'roles' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'roles','name'=>'Permissions','name_ar'=>'الصلاحيات' ],
        'alertMass'=> ['id'=> 'alertMass' ,'group'=>'admin','file_name'=> 'alertMass','name_en'=>'Alert Mass','name_ar'=>'رسائل التحذير' ],
        'deleteMass'=> ['id'=> 'deleteMass','group'=>'admin','file_name'=>'deleteMass','name'=>'Delete Mass','name_ar'=>'رسائل الحذف' ],
        'form'=> ['id'=> 'form' , 'group'=>'admin' , 'file_name'=> 'form','name_en'=>'Forms','name_ar'=>'الفورم' ],
        'def' => ['id'=> 'def' , 'group'=>'admin' , 'file_name'=> 'def','name_en'=>'Default Variables','name_ar'=>'المتغيرات الاساسية' ],
        'country'=> ['id'=> 'country' , 'group'=>'admin', 'file_name'=> 'dataCountry','name_en'=>'Country','name_ar'=>'الدول' ],
        'filter'=> ['id'=> 'filter', 'group'=>'admin', 'file_name'=> 'formFilter','name_en'=>'Filter Form','name_ar'=>'فلتر' ],

        'Branch'=> ['id'=> 'Branch','group'=>'admin', 'file_name'=> 'configBranch','name'=>'Branch','name_ar'=>'الفروع' ],
        'Privacy'=> ['id'=> 'Privacy','group'=>'admin', 'file_name'=> 'configPrivacy','name'=>'Privacy','name_ar'=>'سياسية الاستخدام' ],
        'Meta'=> ['id'=> 'Meta','group'=>'admin', 'file_name'=> 'configMeta','name'=>'Meta Tage','name_ar'=>'ميتا تاج' ],
        'sitemap'=> ['id'=> 'sitemap','group'=>'admin','file_name'=> 'configSitemap','name'=>'SiteMap' ,'name_ar'=>'خريطة الموقع'],
        'Apps'=> ['id'=> 'Apps' , 'group'=>'admin' , 'file_name'=> 'configApp','name'=>'AppSetting','name_ar'=>'اعدادات التطبيق' ],
        'newsletter'=> ['id'=> 'newsletter','group'=>'admin','file_name'=> 'leadsNewsLetter','name'=>'Newsletter','name_ar'=>'القائمة البريدية'],
        'leadForm'=> ['id'=> 'leadForm' , 'group'=>'admin','file_name'=> 'leadsContactUs','name'=>'Lead Form','name_ar'=>'الاتصاللات' ],


//       'cash'=> ['id'=> 'cash' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'cash','name'=>'Cash Mass','name_ar'=>'' ],
    ],

    'webFile' => [
        'menu'=> ['id'=> 'menu' , 'group'=>'web','file_name'=> 'menu','name_en'=>'Menu','name_ar'=>'القائمة' ],
        'newsletter'=> ['id'=> 'newsletter' , 'group'=>'web' ,'file_name'=> 'newsletter','name_en'=>'Newsletter' ,'name_ar'=>'القائمة البريدية' ],

//        'def'=> ['id'=> 'def' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'def','name_en'=>'Default Variables','name_ar'=>'المتغيرات الاساسية' ],
//        'layout'=> ['id'=> 'layout' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'layout','name'=>'Web Layout' ],
//        'contact'=> ['id'=> 'contact' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'contact','name'=>'Contact Us' ],
//

//        'search'=> ['id'=> 'search' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'search','name'=>'Search' ],
//        'home'=> ['id'=> 'home' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'home','name'=>'Home Page' ],
//        'blog'=> ['id'=> 'blog' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'blog','name'=>'Blog' ],
//        'developer'=> ['id'=> 'developer' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'developer','name'=>'Developer' ],
//        'compound'=> ['id'=> 'compound' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'compound','name'=>'Compound' ],
//        'var'=> ['id'=> 'var' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'var','name'=>'Var' ],
//        'err404'=> ['id'=> 'err404' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'err404','name'=>'Error 404' ],
//        'favorite'=> ['id'=> 'favorite' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'favorite','name'=>'Favorite List' ],
//        'Schema'=> ['id'=> 'Schema' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'schema','name'=>'Schema' ],
    ],


];
