<footer class="py-16 mt-20 text-sm text-center text-gray-600 dark:text-gray-300">
    <div class="container mx-auto px-4">

        <div class="flex flex-wrap text-center lg:text-left">

            <!-- Social -->
            <div class="w-full lg:w-6/12 px-4">
                <h4 class="text-3xl font-semibold">با ما در ارتباط باشید</h4>

                <div class="mt-6 flex justify-center lg:justify-start gap-4">
                    <a href="#" class="hover:text-yellow-500 transition">تلگرام</a>
                    <a href="#" class="hover:text-yellow-500 transition">فیسبوک</a>
                    <a href="#" class="hover:text-yellow-500 transition">توییتر</a>
                    <a href="#" class="hover:text-yellow-500 transition">اینستاگرام</a>
                </div>
            </div>

            <!-- Links -->
            <div class="w-full lg:w-6/12 px-4 mt-10 lg:mt-0">
                <div class="flex flex-wrap">

                    <div class="w-full lg:w-1/2">
            <span class="block mb-3 font-semibold uppercase text-gray-500">
              لینک های مرتبط
            </span>
                        <ul class="space-y-2">
                            <li><a href="{{ route('about') }}" class="hover:text-gray-900 dark:hover:text-white">درباره ما</a></li>
                            <li><a href="{{ route('blog') }}" class="hover:text-gray-900 dark:hover:text-white">بلاگ</a></li>
                        </ul>
                    </div>

                    <div class="w-full lg:w-1/2 mt-6 lg:mt-0">
            <span class="block mb-3 font-semibold uppercase text-gray-500">
              منابع
            </span>
                        <ul class="space-y-2">
                            <li><a href="{{ route('rules') }}" class="hover:text-gray-900 dark:hover:text-white">قوانین</a></li>
                            <li><a href="{{ route('privacy') }}" class="hover:text-gray-900 dark:hover:text-white">حریم خصوصی</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-gray-900 dark:hover:text-white">تماس</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

        <hr class="my-8 border-gray-300 dark:border-gray-700">

        <div class="text-center">
            Copyright © 2026
        </div>

    </div>
</footer>
