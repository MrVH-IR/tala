<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Order\SellJob;
use App\Sell\Validation;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellController extends Controller
{
    use Validation;

    public function requestSell(Request $request): RedirectResponse
    {
        try {
            $sale = session()->get('sale');
            if (empty($sale)) {
                return redirect()->route('dashboard.payment.sell')
                    ->with(['notification' => [
                        'message' => 'شما درخواستی برای فروش ثبت نکرده اید.',
                        'type' => 'error']]);
            }

            $error = $this->validateSell($sale);

            if ($error) {
                return redirect()
                    ->route('dashboard')
                    ->with(['notification' => [
                        'message' => $error,
                        'type' => 'error']]);
            }

            $sale['key'] = Str::uuid()->toString();
            SellJob::dispatch($sale)->onQueue('default')->delay(now()->addSeconds(5));

            return redirect()
                ->route('dashboard')
                ->with('notification', [
                    'type' => 'success',
                    'message' => 'درخواست شما با موفقیت ثبت شد',
                ]);
        } catch (HttpException $e) {
            $errorID = now()->format('YmdHis').rand(1000, 9999);
            Log::error("HTTP Exception: $errorID ".$e->getMessage().PHP_EOL);

            return redirect()->route('dashboard.sell')
                ->with(['notification' => [
                    'message' => 'مشکلی در ثبت فروش پیش آمده است '.$errorID,
                    'type' => 'error',
                ]]);
        } catch (Exception $e) {
            $errorID = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Exception: $errorID ".$e->getMessage().PHP_EOL);

            return redirect()->route('dashboard.sell')
                ->with(['notification' => [
                    'message' => 'مشکلی در ثبت فروش پیش آمده است '.$errorID,
                    'type' => 'error',
                ]]);
        }
    }
}
