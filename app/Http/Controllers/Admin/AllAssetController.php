<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Wallet;

class AllAssetController extends Controller
{
    public function index()
    {
        $assets = Wallet::with(['user', 'asset'])
            ->where('balance', '>=', 0)
            ->latest()
            ->paginate(10);

        return view('admin.assets.allAssets.index', compact('assets'));
    }
}
