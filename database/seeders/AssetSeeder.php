<?php

namespace Database\Seeders;

use App\Models\Accounter\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assets = [
            // Gold
            ['symbol' => 'IR_GOLD_18K', 'name' => 'طلای 18 عیار', 'category' => 'gold'],
            ['symbol' => 'IR_GOLD_24K', 'name' => 'طلای 24 عیار', 'category' => 'gold'],
            ['symbol' => 'IR_GOLD_MELTED', 'name' => 'طلای آب‌شده نقدی', 'category' => 'gold'],
            ['symbol' => 'XAUUSD', 'name' => 'انس طلا', 'category' => 'gold'],
            ['symbol' => 'IR_COIN_1G', 'name' => 'سکه یک گرمی', 'category' => 'gold'],
            ['symbol' => 'IR_COIN_QUARTER', 'name' => 'ربع سکه', 'category' => 'gold'],
            ['symbol' => 'IR_COIN_HALF', 'name' => 'نیم سکه', 'category' => 'gold'],
            ['symbol' => 'IR_COIN_EMAMI', 'name' => 'سکه امامی', 'category' => 'gold'],
            ['symbol' => 'IR_COIN_BAHAR', 'name' => 'سکه بهار آزادی', 'category' => 'gold'],

            // Currency
            ['symbol' => 'USDT_IRT', 'name' => 'دلار تتر', 'category' => 'currency'],
            ['symbol' => 'USD', 'name' => 'دلار', 'category' => 'currency'],
            ['symbol' => 'EUR', 'name' => 'یورو', 'category' => 'currency'],
            ['symbol' => 'AED', 'name' => 'درهم امارات', 'category' => 'currency'],
            ['symbol' => 'GBP', 'name' => 'پوند', 'category' => 'currency'],
            ['symbol' => 'JPY', 'name' => 'یکصد ین ژاپن', 'category' => 'currency'],
            ['symbol' => 'KWD', 'name' => 'دینار کویت', 'category' => 'currency'],
            ['symbol' => 'AUD', 'name' => 'دلار استرالیا', 'category' => 'currency'],
            ['symbol' => 'CAD', 'name' => 'دلار کانادا', 'category' => 'currency'],
            ['symbol' => 'CNY', 'name' => 'یوآن چین', 'category' => 'currency'],
            ['symbol' => 'TRY', 'name' => 'لیر ترکیه', 'category' => 'currency'],
            ['symbol' => 'SAR', 'name' => 'ریال عربستان', 'category' => 'currency'],
            ['symbol' => 'CHF', 'name' => 'فرانک سوئیس', 'category' => 'currency'],
            ['symbol' => 'INR', 'name' => 'روپیه هند', 'category' => 'currency'],
            ['symbol' => 'PKR', 'name' => 'روپیه پاکستان', 'category' => 'currency'],
            ['symbol' => 'IQD', 'name' => 'دینار عراق', 'category' => 'currency'],
            ['symbol' => 'SYP', 'name' => 'لیر سوریه', 'category' => 'currency'],
            ['symbol' => 'SEK', 'name' => 'کرون سوئد', 'category' => 'currency'],
            ['symbol' => 'QAR', 'name' => 'ریال قطر', 'category' => 'currency'],
            ['symbol' => 'OMR', 'name' => 'ریال عمان', 'category' => 'currency'],
            ['symbol' => 'BHD', 'name' => 'دینار بحرین', 'category' => 'currency'],
            ['symbol' => 'AFN', 'name' => 'افغانی', 'category' => 'currency'],
            ['symbol' => 'MYR', 'name' => 'رینگیت مالزی', 'category' => 'currency'],
            ['symbol' => 'THB', 'name' => 'بات تایلند', 'category' => 'currency'],
            ['symbol' => 'RUB', 'name' => 'روبل روسیه', 'category' => 'currency'],
            ['symbol' => 'AZN', 'name' => 'منات آذربایجان', 'category' => 'currency'],
            ['symbol' => 'AMD', 'name' => 'درام ارمنستان', 'category' => 'currency'],
            ['symbol' => 'GEL', 'name' => 'لاری گرجستان', 'category' => 'currency'],

            // Cryptocurrency
            ['symbol' => 'BTC', 'name' => 'بیت‌کوین', 'category' => 'cryptocurrency'],
            ['symbol' => 'ETH', 'name' => 'اتریوم', 'category' => 'cryptocurrency'],
            ['symbol' => 'USDT', 'name' => 'تتر', 'category' => 'cryptocurrency'],
            ['symbol' => 'XRP', 'name' => 'ایکس‌آر‌پی', 'category' => 'cryptocurrency'],
            ['symbol' => 'BNB', 'name' => 'بی‌ان‌بی', 'category' => 'cryptocurrency'],
            ['symbol' => 'SOL', 'name' => 'سولانا', 'category' => 'cryptocurrency'],
            ['symbol' => 'USDC', 'name' => 'یواس‌دی کوین', 'category' => 'cryptocurrency'],
            ['symbol' => 'TRX', 'name' => 'ترون', 'category' => 'cryptocurrency'],
            ['symbol' => 'DOGE', 'name' => 'دوج‌کوین', 'category' => 'cryptocurrency'],
            ['symbol' => 'ADA', 'name' => 'کاردانو', 'category' => 'cryptocurrency'],
            ['symbol' => 'LINK', 'name' => 'چین‌لینک', 'category' => 'cryptocurrency'],
            ['symbol' => 'XLM', 'name' => 'استلار', 'category' => 'cryptocurrency'],
            ['symbol' => 'AVAX', 'name' => 'آوالانچ', 'category' => 'cryptocurrency'],
            ['symbol' => 'SHIB', 'name' => 'شیبا اینو', 'category' => 'cryptocurrency'],
            ['symbol' => 'LTC', 'name' => 'لایت‌کوین', 'category' => 'cryptocurrency'],
            ['symbol' => 'DOT', 'name' => 'پولکادات', 'category' => 'cryptocurrency'],
            ['symbol' => 'UNI', 'name' => 'یونی‌سواپ', 'category' => 'cryptocurrency'],
            ['symbol' => 'ATOM', 'name' => 'کازماس', 'category' => 'cryptocurrency'],
            ['symbol' => 'FIL', 'name' => 'فایل‌کوین', 'category' => 'cryptocurrency'],
        ];

        foreach ($assets as $asset) {
            Asset::create($asset);
        }
    }
}
