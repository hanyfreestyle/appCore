<?php

namespace Database\Seeders\roles;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {

    public function run(): void {

        $data = [

            ['cat_id' => 'users', 'name' => 'users_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'users', 'name' => 'users_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'users', 'name' => 'users_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'users', 'name' => 'users_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'users', 'name' => 'users_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],

            ['cat_id' => 'roles', 'name' => 'roles_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'roles', 'name' => 'roles_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'roles', 'name' => 'roles_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'roles', 'name' => 'roles_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'roles', 'name' => 'roles_update_permissions', 'name_ar' => 'تعديل صلاحيات المجموعة', 'name_en' => 'Roles Update Permissions'],

            ['cat_id' => 'config', 'name' => 'config_view', 'name_ar' => 'عرض الاعدادات', 'name_en' => 'Setting View'],
            ['cat_id' => 'config', 'name' => 'config_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'config', 'name' => 'config_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'config', 'name' => 'config_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'config', 'name' => 'config_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ['cat_id' => 'config', 'name' => 'config_website', 'name_ar' => 'اعدادات الموقع', 'name_en' => 'Web Site Setting'],
            ['cat_id' => 'config', 'name' => 'config_meta_view', 'name_ar' => 'ميتا تاج', 'name_en' => 'Meta'],
            ['cat_id' => 'config', 'name' => 'config_defPhoto_view', 'name_ar' => 'الصور الافتراضية', 'name_en' => 'View'],
            ['cat_id' => 'config', 'name' => 'config_upFilter_view', 'name_ar' => 'فلاتر الصور', 'name_en' => 'View'],
            ['cat_id' => 'config', 'name' => 'config_newsletter', 'name_ar' => 'القائمة البريدية', 'name_en' => 'News Letter'],
            ['cat_id' => 'config', 'name' => 'adminlang_view', 'name_ar' => 'ملفات لغة التحكم', 'name_en' => 'Admin Lang File'],
            ['cat_id' => 'config', 'name' => 'weblang_view', 'name_ar' => 'ملفات لغة الموقع', 'name_en' => 'Web Lang File'],
            ['cat_id' => 'config', 'name' => 'config_web_privacy', 'name_ar' => 'سياسية الاستخدام', 'name_en' => 'Web Privacy'],
            ['cat_id' => 'config', 'name' => 'sitemap_view', 'name_ar' => 'SiteMap', 'name_en' => 'SiteMap'],
            ['cat_id' => 'config', 'name' => 'config_branch', 'name_ar' => 'الفروع', 'name_en' => 'Branch'],

            ['cat_id' => 'data', 'name' => 'data_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'data', 'name' => 'data_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'data', 'name' => 'data_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'data', 'name' => 'data_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'data', 'name' => 'data_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ['cat_id' => 'data', 'name' => 'country_view', 'name_ar' => 'الدول', 'name_en' => 'Country'],

            ['cat_id' => 'leads', 'name' => 'leads_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'leads', 'name' => 'leads_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'leads', 'name' => 'leads_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'leads', 'name' => 'leads_export', 'name_ar' => 'تصدير', 'name_en' => 'Export'],
            ['cat_id' => 'leads', 'name' => 'leads_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],

            ['cat_id' => 'app_setting', 'name' => 'AppSetting_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'app_setting', 'name' => 'AppSetting_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'app_setting', 'name' => 'AppSetting_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'app_setting', 'name' => 'AppSetting_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'app_setting', 'name' => 'AppSetting_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],

            ['cat_id' => 'Product', 'name' => 'Product_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'Product', 'name' => 'Product_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'Product', 'name' => 'Product_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'Product', 'name' => 'Product_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'Product', 'name' => 'Product_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],


        ];

        $countData = Permission::all()->count();
        if($countData == '0') {
            foreach ($data as $value) {
                Permission::create($value);
            }
        }

    }
}
