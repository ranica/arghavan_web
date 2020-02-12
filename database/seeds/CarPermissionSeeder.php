<?php

use Illuminate\Database\Seeder;

class CarPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Permission::create([
              'key' => 'menu_structure',
              'subkey' => 'menu_base_parking',
              'name' => 'منوی اطلاعات پایه خودرو',
              'description' => 'فعال یا غیرفعال کردن آیتم اطلاعات پایه در منوی اطلاعات پایه خودرو'
            ]);

            \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_site',
                'name' => 'آیتم تعریف پارکینگ',
                'description' => 'فعال یا غیرفعال کردن آیتم تعریف پارکینگ در منوی اطلاعات پایه خودرو'
              ]);

              \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_color',
                'name' => 'آیتم رنگ خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم رنگ خودرو در منوی اطلاعات پایه خودرو'
              ]);

              \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_fuel',
                'name' => 'آیتم سوخت خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم سوخت خودرو در منوی اطلاعات پایه خودرو'
              ]);

               \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_level',
                'name' => 'آیتم تیپ خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم تیپ خودرو در منوی اطلاعات پایه خودرو'
              ]);

                \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_model',
                'name' => 'آیتم مدل خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم مدل خودرو در منوی اطلاعات پایه خودرو'
              ]);

              \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_system',
                'name' => 'آیتم سیستم خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم سیستم خودرو در منوی اطلاعات پایه خودرو'
              ]);

              \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_type',
                'name' => 'آیتم نوع خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم نوع خودرو در منوی اطلاعات پایه خودرو'
              ]);

              \App\Permission::create([
                'key' => 'menu_base_parking',
                'subkey' => 'car_plate_type',
                'name' => 'آیتم نوع پلاک خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم نوع پلاک خودرو در منوی اطلاعات پایه خودرو'
              ]);

            \App\Permission::create([
                'key' => 'menu_parking',
                'subkey' => 'menu_parking',
                'name' => 'منوی مدیریت پارکینگ',
                'description' => 'فعال یا غیرفعال کردن منوی اطلاعات مدیریت پارکینگ'
            ]);

              \App\Permission::create([
                'key' => 'menu_parking',
                'subkey' => 'car_management_parking',
                'name' => 'آیتم ثبت خودرو',
                'description' => 'فعال یا غیرفعال کردن آیتم ثبت خودرو در منوی مدیریت پارکینگ'
              ]);

              \App\Permission::create([
                'key' => 'menu_parking',
                'subkey' => 'car_capacity_parking',
                'name' => 'ثبت ظرفیت پارکینگ',
                'description' => 'فعال یا غیرفعال کردن آیتم ثبت ظرفبت پارکینگ در منوی مدیریت پارکینگ'
              ]);
    }
}
