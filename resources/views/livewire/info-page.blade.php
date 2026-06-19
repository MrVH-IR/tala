<div class="max-w-4xl mx-auto py-16 px-4" dir="rtl">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
            @if($type === 'resources') منابع مفید @elseif($type === 'rules') قوانین @elseif($type === 'privacy') حریم خصوصی @else اطلاعات @endif
        </h1>
        <p class="text-gray-600 dark:text-gray-400">اطلاعات جامع و راهنمای کاربر برای تجربه بهتر در گلدینا</p>
    </div>

    <div class="p-8 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm prose prose-slate dark:prose-invert max-w-none">
        @if($type === 'resources')
            <h2 class="text-2xl font-bold mb-4">منابع یادگیری سرمایه‌گذاری</h2>
            <p class="mb-6">برای شروع سرمایه‌گذاری در طلا و ارزهای دیجیتال، منابع زیر را پیشنهاد می‌کنیم:</p>
            <ul class="space-y-4 list-disc pr-5">
                <li><a href="#" class="text-yellow-600 dark:text-yellow-500 hover:underline">راهنمای جامع خرید طلا برای مبتدیان</a></li>
                <li><a href="#" class="text-yellow-600 dark:text-yellow-500 hover:underline">تحلیل بازار ارزهای دیجیتال در سال ۲۰۲۶</a></li>
                <li><a href="#" class="text-yellow-600 dark:text-yellow-500 hover:underline">تفاوت‌های سرمایه‌گذاری در طلا و بیت‌کوین</a></li>
                <li><a href="#" class="text-yellow-600 dark:text-yellow-500 hover:underline">مدیریت ریسک در معاملات روزانه</a></li>
            </ul>
        @elseif($type === 'rules')
            <h2 class="text-2xl font-bold mb-4">قوانین و مقررات معاملاتی</h2>
            <div class="space-y-6">
                <section>
                    <h3 class="text-xl font-semibold mb-2">۱. احراز هویت</h3>
                    <p>تمامی کاربران برای انجام تراکنش‌های بالای سقف تعیین شده ملزم به تکمیل مراحل احراز هویت هستند.</p>
                </section>
                <section>
                    <h3 class="text-xl font-semibold mb-2">۲. نحوه محاسبه قیمت</h3>
                    <p>قیمت‌ها بر اساس نرخ لحظه‌ای بازار جهانی با احتساب کارمزد شبکه و خدمات گلدینا محاسبه می‌گردند.</p>
                </section>
                <section>
                    <h3 class="text-xl font-semibold mb-2">۳. لغو سفارشات</h3>
                    <p>سفارشات پس از تایید نهایی و ثبت در شبکه، قابل لغو یا ویرایش نخواهند بود.</p>
                </section>
            </div>
        @elseif($type === 'privacy')
            <h2 class="text-2xl font-bold mb-4">سیاست حریم خصوصی</h2>
            <div class="space-y-6">
                <section>
                    <h3 class="text-xl font-semibold mb-2">جمع‌آوری داده‌ها</h3>
                    <p>ما تنها اطلاعات ضروری برای برقراری ارتباط و انجام تراکنش‌های مالی را از شما دریافت می‌کنیم.</p>
                </section>
                <section>
                    <h3 class="text-xl font-semibold mb-2">محرمانگی اطلاعات</h3>
                    <p>اطلاعات شما در امن‌ترین سرورها ذخیره شده و به هیچ عنوان در اختیار شخص ثالث قرار نخواهد گرفت.</p>
                </section>
                <section>
                    <h3 class="text-xl font-semibold mb-2">کوکی‌ها</h3>
                    <p>از کوکی‌ها برای بهبود تجربه کاربری و بهینه‌سازی رابط کاربری استفاده می‌کنیم.</p>
                </section>
            </div>
        @endif
    </div>
</div>
