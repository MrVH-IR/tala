<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admins = Admin::all();
        if ($admins->isEmpty()) {
            return;
        }

        $posts = [
            [
                'title' => 'راهنمای جامع سرمایه‌گذاری در طلای ۱۸ عیار',
                'content' => 'طلا همواره یکی از امن‌ترین دارایی‌ها برای حفظ ارزش پول در برابر تورم بوده است. در این مقاله بررسی می‌کنیم که چرا طلای ۱۸ عیار برای سرمایه‌گذاری کوتاه‌مدت مناسب‌تر است...',
                'image' => 'images/golds/gold-bar.jpg',
                'is_pinned' => true,
                'tags' => ['سرمایه گذاری', 'طلا', 'راهنما'],
            ],
            [
                'title' => 'تحلیل قیمت بیت‌کوین در نیمه اول سال ۲۰۲۶',
                'content' => 'با ظهور استانداردهای جدید در حوزه پرداخت‌های دیجیتال، بیت‌کوین بار دیگر شاهد رشد چشمگیری است. در این تحلیل به بررسی نقاط حمایتی و مقاومتی می‌پردازیم...',
                'image' => 'images/golds/gold-bar1.jpg',
                'is_pinned' => false,
                'tags' => ['کریپتو', 'بیت کوین', 'تحلیل'],
            ],
            [
                'title' => 'تأثیر نرخ بهره فدرال رزرو بر قیمت دلار',
                'content' => 'تغییرات نرخ بهره توسط بانک مرکزی آمریکا مستقیماً بر تقاضای جهانی دلار و در نتیجه قیمت آن در بازارهای داخلی تأثیر می‌گذارد...',
                'image' => 'images/golds/gold-bar2.jpg',
                'is_pinned' => false,
                'tags' => ['ارز', 'اقتصاد', 'دلار'],
            ],
            [
                'title' => 'چگونه از گلدینا برای خرید امن استفاده کنیم؟',
                'content' => 'امنیت کاربران اولویت اول ماست. در این پست تمامی مراحل خرید از پنل گلدینا و نحوه تایید تراکنش‌ها را گام به گام توضیح داده‌ایم...',
                'image' => 'images/golds/gold-bar3.jpg',
                'is_pinned' => true,
                'tags' => ['راهنما', 'امنیت', 'گلدینا'],
            ],
            [
                'title' => 'مقایسه طلا و اتریوم در سال ۲۰۲۶',
                'content' => 'آیا بهتر است سرمایه خود را در طلا قرار دهید یا در اتریوم؟ در این مقاله مزایا و معایب هر دو را از نظر نقدشوندگی و ریسک بررسی می‌کنیم...',
                'image' => 'images/golds/gold-bar4.jpg',
                'is_pinned' => false,
                'tags' => ['مقایسه', 'طلا', 'اتریوم'],
            ],
        ];

        foreach ($posts as $postData) {
            Post::create([
                'admin_id' => $admins->random()->id,
                ...$postData,
            ]);
        }
    }
}
