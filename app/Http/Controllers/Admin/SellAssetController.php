<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Order;
use App\Order\OrderStatusEnum as Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellAssetController extends Controller
{
    public function index()
    {
        $assets = Order::with(['asset', 'user'])
            ->where(function ($q) {
                $q->where('type', 'SELL')
                    ->where('status', 'REQUESTED');
            })
            ->paginate();

        return view('admin.assets.sell_assets.index', compact('assets'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $assets = Order::with(['user', 'asset'])
            ->where('type', 'SELL')
            ->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('mobile', 'like', "%$query%")
                    ->orWhere('last_name', 'like', "%$query%")
                    ->orWhere('national_code', 'like', "%$query%");
            })
            ->orWhereHas('asset', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('symbol', 'like', "%$query%");
            })
            ->get();

        return response()->json($assets);
    }

    public function sellAsset(Request $request , Order $order)
    {
        $status = Status::from($request->status);
        $order->lockForUpdate();
        dd($request->all() , $status , Status::PENDING , $order);
        match ($status) {
            Status::PAID => $order->update(['status', Status::PAID]),
            Status::PENDING => $order->update(['status', Status::PENDING]),
            Status::REJECTED => $order->update(['status', Status::REJECTED]),
            Status::CANCELLED => $order->update(['status', Status::CANCELLED]),
            Status::COMPLETED => $order->update(['status', Status::COMPLETED]),
            default => $order->update(['status', Status::REQUESTED]),
        };

        if ($status === Status::COMPLETED) {
            DB::transaction(function () use ($request) {

            });
        }
    }
}
