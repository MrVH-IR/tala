<?php

namespace App\Http\Middleware\Buy;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasPaymentProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $card = $user->userCreditCardInformation;
        if (
            ! $user->national_code ||
            ! $user->mobile ||
            ! $card?->sheba ||
            ! $card?->card_number
        ) {
            return redirect()
                ->route('dashboard.setting.profile')
                ->with('error', 'برای خرید باید اطلاعات کاربری خود را تکمیل کنید');
        }

        return $next($request);
    }
}
