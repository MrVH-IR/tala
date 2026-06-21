<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>هشدار امنیتی</title>
</head>

<body style="margin:0;background:#0b1220;font-family:tahoma,sans-serif;color:#e5e7eb;">

<div style="max-width:720px;margin:40px auto;padding:20px;">

    <!-- Card -->
    <div style="background:#111827;border-radius:18px;overflow:hidden;box-shadow:0 20px 50px rgba(0,0,0,.4);">

        <!-- Header -->
        <div style="padding:30px;background:linear-gradient(135deg,#ef4444,#f97316);text-align:center;">
            <h1 style="margin:0;font-size:26px;color:#fff;">
                🔐 هشدار امنیتی حساب
            </h1>

            <p style="margin-top:10px;color:#ffe4e6;">
                تغییر مهم در حساب کاربری شما ثبت شد
            </p>
        </div>

        <!-- Body -->
        <div style="padding:30px;">

            <p style="font-size:16px;">
                سلام <strong style="color:#fff">{{ $user->name }}</strong> عزیز،
            </p>

            @php
                $isPassword = $changeType === 'password';
            @endphp

            <div style="
                margin-top:20px;
                padding:18px;
                border-radius:12px;
                background:#1f2937;
                border-right:4px solid {{ $isPassword ? '#ef4444' : '#3b82f6' }};
            ">

                <p style="margin:0;font-size:15px;line-height:1.8;">
                    @if($isPassword)
                        رمز عبور حساب شما با موفقیت تغییر کرده است.
                        <br><br>
                        اگر این تغییر توسط شما انجام نشده، همین الان وارد حساب خود شوید و رمز را تغییر دهید.
                    @else
                        اطلاعات پروفایل شما با موفقیت به‌روزرسانی شد.
                        <br><br>
                        اگر شما این تغییرات را ایجاد نکرده‌اید، امنیت حساب خود را بررسی کنید.
                    @endif
                </p>

            </div>

            <!-- Meta -->
            <div style="margin-top:25px;padding:15px;background:#0f172a;border-radius:12px;font-size:14px;">
                <div>📅 تاریخ تغییر:</div>
                <div style="color:#93c5fd;margin-top:5px;">
                    {{ $date->format('Y-m-d H:i:s') }}
                </div>
            </div>

            <!-- CTA -->
            <div style="text-align:center;margin-top:30px;">
                <a href="{{ url('/') }}"
                   style="
                        display:inline-block;
                        padding:14px 28px;
                        background:linear-gradient(135deg,#3b82f6,#06b6d4);
                        color:white;
                        text-decoration:none;
                        border-radius:10px;
                        font-weight:bold;
                   ">
                    ورود به حساب کاربری
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div style="padding:20px;text-align:center;background:#0b1220;color:#6b7280;font-size:12px;">
            تیم امنیتی گلدینا — اگر این فعالیت مشکوک است سریع اقدام کنید
        </div>

    </div>

</div>

</body>
</html>
