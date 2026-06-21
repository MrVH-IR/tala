<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ثبت خرید جدید</title>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:tahoma,sans-serif;">

<div style="max-width:700px;margin:40px auto;padding:20px;">

    <div style="
        background:#ffffff;
        border-radius:16px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    ">

        <div style="
            background:linear-gradient(135deg,#ca8a04,#facc15);
            padding:30px;
            text-align:center;
            color:white;
        ">
            <h1 style="margin:0;font-size:28px;">
                🪙 خرید جدید ثبت شد
            </h1>

            <p style="margin-top:10px;opacity:.9;">
                سفارش جدیدی در گلدینا ایجاد شده است
            </p>
        </div>

        <div style="padding:30px;">

            <p style="font-size:16px;color:#374151;">
                یک خرید جدید در سیستم ثبت شده است.
            </p>

            <table style="
                width:100%;
                border-collapse:collapse;
                margin-top:25px;
            ">
                <tr>
                    <td style="padding:12px;background:#f9fafb;font-weight:bold;">
                        ایمیل کاربر
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                        {{ $user->email }}
                    </td>
                </tr>

                <tr>
                    <td style="padding:12px;background:#f9fafb;font-weight:bold;">
                        نام کاربر
                    </td>

                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                        {{ $user->full_name }}
                    </td>
                </tr>

                <tr>
                    <td style="padding:12px;background:#f9fafb;font-weight:bold;">
                        نوع دارایی
                    </td>

                    <td style="padding:12px;">
                        {{ $assetName }}
                    </td>
                </tr>

                <tr>
                    <td style="padding:12px;background:#f9fafb;font-weight:bold;">
                        مبلغ سفارش
                    </td>

                    <td style="
                        padding:12px;
                        color:#16a34a;
                        font-weight:bold;
                        font-size:18px;
                    ">
                        {{ number_format($order->total_money) }} تومان
                    </td>
                </tr>

                <tr>
                    <td style="padding:12px;background:#f9fafb;font-weight:bold;">
                        زمان ثبت
                    </td>

                    <td style="padding:12px;">
                        {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}
                    </td>
                </tr>
            </table>

            <div style="text-align:center;margin-top:35px;">
                <a
                    href="{{ route('dashboard') }}"
                    style="
                        display:inline-block;
                        background:#ca8a04;
                        color:white;
                        text-decoration:none;
                        padding:14px 30px;
                        border-radius:10px;
                        font-weight:bold;
                    "
                >
                    ورود به داشبورد
                </a>
            </div>

        </div>

        <div style="
            background:#f9fafb;
            padding:20px;
            text-align:center;
            color:#6b7280;
            font-size:13px;
        ">
            Goldina Notification System
        </div>

    </div>

</div>

</body>
</html>
