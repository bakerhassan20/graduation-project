<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [

    'الاوردرات',
    'قائمة الاوردرات',
    'الاوردرات المدفوعة',
    'الاوردرات المدفوعة جزئيا',
    'الاوردرات الغير مدفوعة',
    'ارشيف الاوردرات',
    'التقارير',
    'تقرير الاوردرات',
    'تقرير العملاء',
    'المستخدمين',
    'قائمة المستخدمين',
    'صلاحيات المستخدمين',
    'الاعدادات',
    'الخدمات',
    'الاقسام',


    'اضافة اوردر',
    'حذف اوردر',
    'تصدير EXCEL',
    'تغير حالة الدفع',
    'تعديل اوردر',
    'ارشفة اوردر',
    'طباعةاوردر',
    'اضافة مرفق',
    'حذف المرفق',

    'اضافة مستخدم',
    'تعديل مستخدم',
    'حذف مستخدم',

    'عرض صلاحية',
    'اضافة صلاحية',
    'تعديل صلاحية',
    'حذف صلاحية',

    'اضافة خدمه',
    'تعديل خدمه',
    'حذف خدمه',

    'اضافة قسم',
    'تعديل قسم',
    'حذف قسم',
    'الاشعارات',


];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}
