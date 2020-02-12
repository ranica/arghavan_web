<?php

use Illuminate\Database\Seeder;

class GateMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gatemessage::create([
            'message' => 'تردد انجام شد'
        ]);

        \App\Gatemessage::create([
            'message' => 'تردد انجام نشد'
        ]);

        \App\Gatemessage::create([
            'message' => 'شخص مجوز تردد دارد'
        ]);

        \App\Gatemessage::create([
            'message' => 'قبلا تردد داشته است'
        ]);

        \App\Gatemessage::create([
            'message' => 'عدم مجوز تردد در این ناحیه'
        ]);

        \App\Gatemessage::create([
            'message' => 'جنسیت مطابقت ندارد'
        ]);

        \App\Gatemessage::create([
            'message' => 'دستگاه غیرفعال است'
        ]);

        \App\Gatemessage::create([
            'message' => 'شما غیرفعال می باشید'
        ]);

        \App\Gatemessage::create([
            'message' => 'اتمام تاریخ اعتبار کارت'
        ]);

        \App\Gatemessage::create([
            'message' => 'تاریخ تردد مجاز نیست'
        ]);

        \App\Gatemessage::create([
            'message' => 'شخص خوابگاهی نمی باشد'
        ]);

        \App\Gatemessage::create([
            'message' => 'کارت ناشناخته است'
        ]);

        \App\Gatemessage::create([
            'message' => 'وضعیت اضطراری می باشد'
        ]);

        \App\Gatemessage::create([
            'message' => 'مجوز توسط نگهبان صادر شد'
        ]);

        \App\Gatemessage::create([
            'message' => 'مجوز اتوماتیک صادر شد'
        ]);

        \App\Gatemessage::create([
            'message' => 'تردد همزمان از دو'
        ]);

        \App\Gatemessage::create([
            'message' => 'دستگاه ناشناخته است'
        ]);

    }
}
