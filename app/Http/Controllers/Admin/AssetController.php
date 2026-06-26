<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $wallets = Wallet::latest()
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.assets.index', compact('wallets'));
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $wallets = Wallet::with(['user', 'asset'])
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

        return response()->json($wallets);
    }
}
