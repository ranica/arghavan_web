<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        #region Menu Dashboard
            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' => 'button_notification',
                'name' => 'نمایش دکمه آلارم درخواست ها در منوی بالا',
                'description' => 'نمایش یا عدم نمایش دکمه آلارم درخواست های جدید در منوی بالای صفحه'
            ]);

            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' => 'button_alarm_sms',
                'name' => 'نمایش دکمه تعداد پیامک های رسیده در منوی بالا',
                'description' => 'نمایش یا عدم نمایش دکمه تعداد پیامک های رسیده در منوی بالای صفحه'
            ]);

            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' =>'button_dashboard',
                'name' => 'نمایش دکمه داشبورد من در منوی بالا',
                'description' => 'نمایش یا عدم نمایش دکمه داشبورد من در منوی بالای صفحه'
            ]);
            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' =>'button_monitor',
                'name' => 'نمایش دکمه مانیتورینگ تردد در منوی بالا',
                'description' => 'نمایش یا عدم نمایش دکمه مانیتورینگ تردد در منوی بالای صفحه'
            ]);

            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' => 'button_report',
                'name' => 'نمایش دکمه گزارش ورود و خروج در منوی بالا',
                'description' => 'نمایش یا عدم نمایش گزارش ورود و خروج در منوی بالای صفحه'
            ]);

            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' => 'button_sms',
                'name' => 'نمایش دکمه ارسال پیامک در منوی بالا',
                'description' => 'نمایش یا عدم نمایش دکمه ارسال پیامک در منوی بالای صفحه'
            ]);
        #endregion

        #region Chart Dashboard
            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' => 'chart_number',
                'name' => 'نمایش آمار عددی روی داشبورد',
                'description' => 'نمایش یا عدم نمایش آمار عددی داشبورد در صفحه اصلی برنامه'
            ]);

            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' => 'gate_device',
                'name' => 'نمایش گیت های کنترل تردد داشبورد',
                'description' => 'نمایش یا عدم نمایش گیت های کنترل تردد داشبورد در صفحه اصلی برنامه'
            ]);

            \App\Permission::create([
                'key' => 'dashboard',
                'subkey' =>'chart_traffic',
                'name' => 'نمایش نمودارهای آماری داشبورد',
                'description' => 'نمایش یا عدم نمایش نمودارهای آماری در صفحه اصلی'
            ]);
        #endregion

        #region Item Strcture Organization
            \App\Permission::create([
                'key' => 'menu_structure',
                'subkey' => 'menu_structure',
                'name' => 'منوی مدیریت ساختار سازمانی',
                'description' => 'فعال یا غیرفعال کردن منوی مدیریت ساختار سازمانی'
            ]);

            #region Base Information
                /**
                 * Base Menu
                 */
                    \App\Permission::create([
                        'key' => 'menu_structure',
                        'subkey' => 'menu_base',
                        'name' => 'منوی اطلاعات پایه',
                        'description' => 'فعال یا غیرفعال کردن منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_melliat',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم ملیت',
                        'description' => 'فعال یا غیرفعال کردن آیتم ملیت در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_province',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم استان',
                        'description' => 'فعال یا غیرفعال کردن آیتم استان در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_city',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم شهرستان',
                        'description' => 'فعال یا غیرفعال کردن آیتم شهرستان در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_department',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم ساختمان دانشگاه',
                        'description' => 'فعال یا غیرفعال کردن آیتم ساختمان دانشگاه در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_group',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم گروه بندی',
                        'description' => 'فعال یا غیرفعال کردن آیتم گروه بندی در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_cardtype',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم کارت ها',
                        'description' => 'فعال یا غیرفعال کردن آیتم کارت ها در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_contract',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم قرارداد',
                        'description' => 'فعال یا غیرفعال کردن آیتم قرارداد در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_contractor',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم پیمانکار',
                        'description' => 'فعال یا غیرفعال کردن آیتم پیمانکار در منوی اطلاعات پایه'
                    ]);



                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_block',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم تعریف بلوک',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف بلوک در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_building_type',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم تعریف انواع ساختمان',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف انواع ساختان در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_building',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم تعریف ساختمان',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف ساختان در منوی اطلاعات پایه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_base',
                        'subkey' => 'base_kintype',
                        'name' => 'منوی اطلاعات پایه ـ فعال سازی آیتم نسبت افراد',
                        'description' => 'فعال یا غیرفعال کردن آیتم نسبت افراد در منوی اطلاعات پایه'
                    ]);
            #endregion

            #region Eduction Information
                /**
                 * Educational Menu
                */
                    \App\Permission::create([
                        'key' => 'menu_structure',
                        'subkey' => 'menu_educational',
                        'name' => 'منوی اطلاعات تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن اطلاعات تحصیلی'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_educational',
                        'subkey' => 'educational_term',
                        'name' => 'منوی اطلاعات تحصیلی ـ فعال سازی آیتم نیمسال تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن آیتم نیمسال تحصیلی در منوی اطلاعات تحصیلی'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_educational',
                        'subkey' => 'educational_university',
                        'name' => 'منوی اطلاعات تحصیلی ـ فعال سازی آیتم دانشکده تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن آیتم دانشکده تحصیلی در منوی اطلاعات تحصیلی'
                    ]);
                    \App\Permission::create([
                        'key' => 'menu_educational',
                        'subkey' => 'educational_field',
                        'name' => 'منوی اطلاعات تحصیلی ـ فعال سازی آیتم رشته تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن آیتم رشته تحصیلی در منوی اطلاعات تحصیلی'
                    ]);
                    \App\Permission::create([
                        'key' => 'menu_educational',
                        'subkey' => 'educational_degree',
                        'name' => 'منوی اطلاعات تحصیلی ـ فعال سازی آیتم مقطع تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن آیتم مقطع تحصیلی در منوی اطلاعات تحصیلی'
                    ]);
                    \App\Permission::create([
                        'key' => 'menu_educational',
                        'subkey' => 'educational_part',
                        'name' => 'منوی اطلاعات تحصیلی ـ فعال سازی آیتم گروه تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن آیتم گروه تحصیلی در منوی اطلاعات تحصیلی'
                    ]);
                    \App\Permission::create([
                        'key' => 'menu_educational',
                        'subkey' => 'educational_situation',
                        'name' => 'منوی اطلاعات تحصیلی ـ فعالل سازی آیتم وضعیت تحصیلی',
                        'description' => 'فعال یا غیرفعال کردن آیتم وضعیت تحصیلی در منوی اطلاعات تحصیلی'
                    ]);
            #endregion

            #region Dormitory Information
                /**
                 * Dormitory Menu
                */
                    \App\Permission::create([
                        'key' => 'menu_structure',
                        'subkey' => 'menu_dormitory',
                        'name' => 'منوی اطلاعات پایه خوابگاه',
                        'description' => 'فعال یا غیرفعال کردن اطلاعات پایه خوابگاه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_dormitory',
                        'subkey' => 'dormitory_room',
                        'name' => 'آیتم تعریف اتاق',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف اتاق در منوی خوابگاه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_dormitory',
                        'subkey' => 'dormitory_material_type',
                        'name' => 'آیتم تعریف نوع تجهیزات',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف نوع تجهیزات در منوی خوابگاه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_dormitory',
                        'subkey' => 'dormitory_material',
                        'name' => 'آیتم تعریف تجهیزات',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف تجهیزات در منوی خوابگاه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_dormitory',
                        'subkey' => 'dormitory_contact_type',
                        'name' => 'آیتم تعریف مخاطبین',
                        'description' => 'فعال یا غیرفعال کردن آیتم تعریف مخاطبین در منوی خوابگاه'
                    ]);

                    \App\Permission::create([
                        'key' => 'menu_dormitory',
                        'subkey' => 'dormitory_phone_book',
                        'name' => 'آیتم دفترچه تلفن',
                        'description' => 'فعال یا غیرفعال کردن آیتم دفترچه تلفن در منوی خوابگاه'
                    ]);
            #endregion
        #endregion

        #region User Manager
            /**
             * User Menu
             */
                \App\Permission::create([
                    'key' => 'menu_user',
                    'subkey' => 'menu_user',
                    'name' => 'منوی مدیریت کاربران',
                    'description' => 'فعال یا غیرفعال کردن منوی مدیریت کاربران'
                ]);
                \App\Permission::create([
                    'key' => 'menu_user',
                    'subkey' => 'user_user',
                    'name' => 'آیتم ثبت کاربر',
                    'description' => 'فعال یا غیرفعال کردن آیتم ثبت کاربر در منوی مدیریت کاربران'
                ]);
                \App\Permission::create([
                    'key' => 'menu_user',
                    'subkey' => 'user_card',
                    'name' => 'آیتم ثبت کارت',
                    'description' => 'فعال یا غیرفعال کردن آیتم ثبت کارت در منوی اطلاعات کاربران'
                ]);

                \App\Permission::create([
                    'key' => 'menu_user',
                    'subkey' => 'user_uploadImage',
                    'name' => 'آیتم آپلود تصاویر',
                    'description' => 'فعال یا غیرفعال کردن آیتم آپلود تصاویر در منوی مدیریت کاربر'
                ]);
        #endregion

        #region Gate Management
            \App\Permission::create([
                'key' => 'menu_gate',
                'subkey' => 'menu_gate',
                'name' => 'منوی مدیریت تردد',
                'description' => 'فعال یا غیرفعال کردن منوی مدیریت تردد'
            ]);

            \App\Permission::create([
                'key' => 'menu_gate',
                'subkey' => 'gate_plan',
                'name' => 'آیتم برنامه تردد',
                'description' => 'فعال یا غیرفعال کردن آیتم برنامه تردد در منوی مدیریت تردد'
            ]);


            \App\Permission::create([
                'key' => 'menu_gate',
                'subkey' => 'gate_zone',
                'name' => 'آیتم منطقه استقرار گیت',
                'description' => 'فعال یا غیرفعال کردن آیتم منطقه استقرار گیت در منوی مدیریت تردد'
            ]);
            \App\Permission::create([
                'key' => 'menu_gate',
                'subkey' => 'gate_gatepass',
                'name' => 'آیتم نحوه عبور از گیت',
                'description' => 'فعال یا غیرفعال کردن آیتم نحوه عبور از گیت در منوی مدیریت تردد'
            ]);
            \App\Permission::create([
                'key' => 'menu_gate',
                'subkey' => 'gate_gate',
                'name' => 'آیتم گیت های ورود و خروج',
                'description' => 'فعال یا غیرفعال کردن آیتم گیت های ورود و خروج در منوی مدیریت تردد'
            ]);
        #endregion

        #region Dormitory Management
            \App\Permission::create([
                'key' => 'menu_management_dormitory',
                'subkey' => 'menu_management_dormitory',
                'name' => 'منوی مدیریت  خوابگاه',
                'description' => 'فعال یا غیرفعال کردن منوی مدیریت خوابگاه'
            ]);

            \App\Permission::create([
                'key' => 'menu_management_dormitory',
                'subkey' => 'building_infomation',
                'name' => 'آیتم تعریف خوابگاه',
                'description' => 'فعال یا غیرفعال کردن آیتم تعریف خوابگاه در منوی مدیریت خوابگاه'
            ]);

            \App\Permission::create([
                'key' => 'menu_management_dormitory',
                'subkey' => 'management_building_infomation',
                'name' => 'آیتم مدیریت خوابگاه',
                'description' => 'فعال یا غیرفعال کردن آیتم مدیریت خوابگاه در منوی مدیریت خوابگاه'
            ]);

        #endregion

        #region Setting

            \App\Permission::create([
                'key' => 'menu_setting',
                'subkey' => 'menu_setting',
                'name' => 'منوی تنظیمات',
                'description' => 'فعال یا غیرفعال کردن منوی تنظیمات'
            ]);


            #region Gate Setting

                \App\Permission::create([
                    'key' => 'menu_setting',
                    'subkey' => 'setting_gate',
                    'name' => 'منوی تنظیمات تردد',
                    'description' => 'فعال یا غیرفعال کردن منوی تنظیمات گیت تردد'
                ]);
                \App\Permission::create([
                    'key' => 'menu_setting',
                    'subkey' => 'setting_group',
                    'name' => 'تخصیص گروه دسترسی',
                    'description' => 'فعال یا غیرفعال کردن آیتم تخصیص گروه های دسترسی در منوی تنظیمات تردد'
                ]);
                \App\Permission::create([
                    'key' => 'menu_setting',
                    'subkey' => 'setting_traffic',
                    'name' => 'آیتم تنظیمات ورود و خروج',
                    'description' => 'فعال یا غیرفعال کردن آیتم تنظیمات ورود و خروج در منوی تنظیمات تردد'
                ]);
            #endregion

            #region System Setting
                \App\Permission::create([
                    'key' => 'menu_auth',
                    'subkey' => 'menu_auth',
                    'name' => 'منوی مدیریت سیستم',
                    'description' => 'فعال یا غیرفعال کردن منوی مدیریت سیستم'
                ]);
                \App\Permission::create([
                    'key' => 'menu_auth',
                    'subkey' => 'auth_permission',
                    'name' => 'آیتم ثبت مجوزها',
                    'description' => 'فعال یا غیرفعال کردن آیتم ثبت مجوزها در منوی مدیریت سیستم'
                ]);
                \App\Permission::create([
                    'key' => 'menu_auth',
                    'subkey' => 'auth_role',
                    'name' => 'آیتم ثبت نقش ها',
                    'description' => 'فعال یا غیرفعال کردن آیتم ثبت نقش ها در منوی مدیریت سیستم'
                ]);
                \App\Permission::create([
                    'key' => 'menu_auth',
                    'subkey' => 'auth_group',
                    'name' => 'آیتم ثبت گروه های دسترسی',
                    'description' => 'فعال یا غیرفعال کردن آیتم ثبت گروه های دسترسی در منوی مدیریت سیستم'
                ]);

            #endregion
        #endregion

        #region Report
            \App\Permission::create([
                'key' => 'menu_report',
                'subkey' => 'menu_report',
                'name' => 'منوی مدیریت گزارشات',
                'description' => 'فعال یا غیرفعال کردن منوی گزارشات'
            ]);
            \App\Permission::create([
                'key' => 'menu_report',
                'subkey' => 'report_traffic',
                'name' => 'آیتم گزارشات ورود و خروج',
                'description' => 'فعال یا غیرفعال کردن آیتم گزارشات ورود و خروج در منوی مدیریت گزارشات'
            ]);

            \App\Permission::create([
                'key' => 'menu_report',
                'subkey' => 'report_monitor',
                'name' => 'آیتم مانیتورینگ تردد',
                'description' => 'فعال یا غیرفعال کردن آیتم گزارشات ورود و خروج در منوی مدیریت گزارشات'
            ]);

            \App\Permission::create([
                'key' => 'menu_report',
                'subkey' => 'report_user',
                'name' => 'آیتم گزارشات کاربران',
                'description' => 'فعال یا غیرفعال کردن آیتم گزارشات کاربران در منوی مدیریت گزارشات'
            ]);
        #endregion

        #region SMS Menu
           \App\Permission::create([
                'key' => 'menu_sms',
                'subkey' => 'menu_sms',
                'name' => 'سامانه پیامک' ,
                'description' => 'فعال یا غیرفعال کردن سامانه پیامک'
            ]);
            \App\Permission::create([
                'key' => 'menu_sms',
                'subkey' => 'sms_manager',
                'name' => 'آیتم مدیریت پیامک ها',
                'description' => 'فعال یا غیرفعال کردن آیتم مدیریت پیامک ها در منوی سامانه پیامک'
            ]);
            \App\Permission::create([
                'key' => 'menu_sms',
                'subkey' => 'sms_send',
                'name' => 'آیتم ارسال پیامک',
                'description' => 'فعال یا غیرفعال کردن آیتم ارسال پیامک در منوی سامانه پیامک'
            ]);
        #endregion

        #region Request
           \App\Permission::create([
                'key' => 'menu_request',
                'subkey' => 'menu_request',
                'name' => 'منوی مدیریت درخواست ها',
                'description' => 'فعال یا غیرفعال کردن منوی مدیریت درخواست ها'
            ]);
            \App\Permission::create([
                'key' => 'menu_request',
                'subkey' => 'request_vacation',
                'name' => 'آیتم ارسال درخواست مرخصی',
                'description' => 'فعال یا غیرفعال کردن آیتم ارسال درخواست مرخصی در منوی درخواست مرخصی'
            ]);
            \App\Permission::create([
                'key' => 'menu_request',
                'subkey' => 'request_check_vacation',
                'name' => 'آیتم بررسی درخواست مرخصی',
                'description' => 'فعال یا غیرفعال کردن آیتم بررسی درخواست مرخصی در منوی مدیریت درخواست ها'
            ]);
        #endregion

        #region referral
            \App\Permission::create([
                'key' => 'menu_referral',
                'subkey' => 'menu_referral',
                'name' => 'منوی مدیریت مراجعه کنندگان',
                'description' => 'فعال یا غیرفعال کردن منوی مدیریت مراجعه کنندگان'
            ]);

            \App\Permission::create([
                'key' => 'menu_referral',
                'subkey' => 'referral_warranty',
                'name' => 'آیتم ثبت ضمانت نامه',
                'description' => 'فعال یا غیرفعال کردن آیتم ثبت ضمانت نامه در منوی مدیریت مراجعه کنندگان'
            ]);

            \App\Permission::create([
                'key' => 'menu_referral',
                'subkey' => 'referral_type',
                'name' => 'آیتم ثبت نوع مراجعه کننده',
                'description' => 'فعال یا غیرفعال کردن آیتم ثبت نوع مراجعه کننده در منوی مدیریت مراجعه کنندگان'
            ]);

            \App\Permission::create([
                'key' => 'menu_referral',
                'subkey' => 'referral_referral',
                'name' => 'آیتم مراجعه کنندگان',
                'description' => 'فعال یا غیرفعال کردن آیتم  مراجعه کنندگان در منوی مدیریت مراجعه کنندگان'
            ]);
        #endregion

        #region Commands
            \App\Permission::create([
              'key' => 'command',
              'subkey' => 'command_insert',
              'name' => 'فعال سازی دکمه ثبت رکورد جدید در فرم ها',
              'description' => 'فعال یا غیرفعال کردن دکمه ثبت رکورد جدید در فرم ها'
            ]);
            \App\Permission::create([
                'key' => 'command',
                'subkey' => 'command_edit',
                'name' => 'فعال سازی دکمه ویرایش رکورد در فرم ها',
                'description' => 'فعال یا غیرفعال کردن دکمه ویرایش رکورد در فرم ها'
            ]);
            \App\Permission::create([
                'key' => 'command',
                'subkey' => 'command_delete',
                'name' => 'فعال سازی دکمه حذف رکورد در فرم ها',
                'description' => 'فعال یا غیرفعال کردن دکمه حذف رکورد در فرم ها'
            ]);
            \App\Permission::create([
                'key' => 'command',
                'subkey' => 'command_permission',
                'name' => 'فعال سازی دکمه اختصاص مجوز در فرم ها',
                'description' => 'فعال یا غیرفعال کردن دکمه اختصاص مجوز در فرم ها'
            ]);
            \App\Permission::create([
                'key' => 'command',
                'subkey' => 'command_show',
                'name' => 'فعال سازی دکمه نمایش اطلاعات در فرم ها',
                'description' => 'فعال یا غیرفعال کردن دکمه نمایش اطلاعات در فرم ها'
            ]);
            \App\Permission::create([
                'key' => 'command',
                'subkey' => 'command_search',
                'name' => 'فعال سازی دکمه جستجوی اطلاعات در فرم ها',
                'description' => 'فعال یا غیرفعال کردن جستجوی اطلاعات در فرم ها'
            ]);
            \App\Permission::create([
                'key' => 'command',
                'subkey' => 'command_savetraffic',
                'name' => 'فعال سازی دکمه ثبت دستی تردد در فرم های گزارشات تردد',
                'description' => 'فعال یا غیرفعال کردن دکمه ثبت دستی تردد در فرم های گزارشات تردد'
            ]);
        #endregion
    }
}
