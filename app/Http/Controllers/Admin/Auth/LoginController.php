<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $key = Str::lower($request->email.'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return redirect()->route('admin.auth.login')
                ->with([
                    'notification' => [
                        'type' => 'warning',
                        'message' => "تعداد تلاش‌های ناموفق بیش از حد مجاز است. {$seconds} ثانیه دیگر تلاش کنید.",
                    ],
                ]);
        }

        $user = Admin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return redirect()->route('admin.auth.login')
                ->with([
                    'notification' => [
                        'type' => 'warning',
                        'message' => 'ایمیل یا پسورد اشتباه می باشد.',
                    ],
                ]);
        }

        RateLimiter::clear($key);
        Auth::guard('admin')->login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.home');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect()->route('admin.auth.login');
    }
}
