<?php

namespace Database\Seeders\roles;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            ['cat_id'=> '1', 'name' => 'users_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '1', 'name' => 'users_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '1', 'name' => 'users_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '1', 'name' => 'users_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '1', 'name' => 'users_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '2', 'name' => 'roles_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '2', 'name' => 'roles_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '2', 'name' => 'roles_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '2', 'name' => 'roles_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '2', 'name' => 'roles_update_permissions','name_ar'=>'تعديل صلاحيات المجموعة','name_en'=>'Roles Update Permissions'],

            ['cat_id'=> '3', 'name' => 'config_view','name_ar'=>'عرض الاعدادات','name_en'=>'Setting View'],
            ['cat_id'=> '3', 'name' => 'config_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '3', 'name' => 'config_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '3', 'name' => 'config_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '3', 'name' => 'config_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],
            ['cat_id'=> '3', 'name' => 'config_website','name_ar'=>'اعدادات الموقع','name_en'=>'Web Site Setting'],
            ['cat_id'=> '3', 'name' => 'config_meta_view','name_ar'=>'ميتا تاج','name_en'=>'Meta'],
            ['cat_id'=> '3', 'name' => 'config_defPhoto_view','name_ar'=>'الصور الافتراضية','name_en'=>'View'],
            ['cat_id'=> '3', 'name' => 'config_upFilter_view','name_ar'=>'فلاتر الصور','name_en'=>'View'],
            ['cat_id'=> '3', 'name' => 'config_newsletter','name_ar'=>'القائمة البريدية','name_en'=>'News Letter'],
            ['cat_id'=> '3', 'name' => 'adminlang_view','name_ar'=>'ملفات لغة التحكم','name_en'=>'Admin Lang File'],
            ['cat_id'=> '3', 'name' => 'weblang_view','name_ar'=>'ملفات لغة الموقع','name_en'=>'Web Lang File'],
            ['cat_id'=> '3', 'name' => 'sitemap_view','name_ar'=>'SiteMap','name_en'=>'SiteMap'],

            ['cat_id'=> '4', 'name' => 'amenity_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '4', 'name' => 'amenity_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '4', 'name' => 'amenity_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '4', 'name' => 'amenity_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '4', 'name' => 'amenity_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '5', 'name' => 'location_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '5', 'name' => 'location_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '5', 'name' => 'location_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '5', 'name' => 'location_delete','name_ar'=>'حذف','name_en'=>'Delete'],


            ['cat_id'=> '6', 'name' => 'developer_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '6', 'name' => 'developer_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '6', 'name' => 'developer_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '6', 'name' => 'developer_delete','name_ar'=>'حذف','name_en'=>'Delete'],

            ['cat_id'=> '7', 'name' => 'pages_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '7', 'name' => 'pages_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '7', 'name' => 'pages_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '7', 'name' => 'pages_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '7', 'name' => 'pages_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '8', 'name' => 'post_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '8', 'name' => 'post_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '8', 'name' => 'post_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '8', 'name' => 'post_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '8', 'name' => 'post_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '9', 'name' => 'project_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '9', 'name' => 'project_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '9', 'name' => 'project_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '9', 'name' => 'project_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '9', 'name' => 'project_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '10', 'name' => 'forSale_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '10', 'name' => 'forSale_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '10', 'name' => 'forSale_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '10', 'name' => 'forSale_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '10', 'name' => 'forSale_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],

            ['cat_id'=> '11', 'name' => 'leads_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '11', 'name' => 'leads_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '11', 'name' => 'leads_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '11', 'name' => 'leads_export','name_ar'=>'تصدير','name_en'=>'Export'],
            ['cat_id'=> '11', 'name' => 'leads_delete','name_ar'=>'حذف','name_en'=>'Delete'],


            ['cat_id'=> '12', 'name' => 'data_view','name_ar'=>'عرض','name_en'=>'View'],
            ['cat_id'=> '12', 'name' => 'data_add','name_ar'=>'اضافة','name_en'=>'Add'],
            ['cat_id'=> '12', 'name' => 'data_edit','name_ar'=>'تعديل','name_en'=>'Edit'],
            ['cat_id'=> '12', 'name' => 'data_delete','name_ar'=>'حذف','name_en'=>'Delete'],
            ['cat_id'=> '12', 'name' => 'data_restore','name_ar'=>'استعادة المحذوف','name_en'=>'Restore'],
            ['cat_id'=> '12', 'name' => 'country_view','name_ar'=>'الدول','name_en'=>'Country'],


        ];

        $countData =  Permission::all()->count();
        if($countData == '0'){
            foreach ($data as $value){
                Permission::create($value);
            }
        }
    }
}
