<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class BankAccountController extends Controller
{
    /**
     * Get all active bank accounts
     */
    public function getActive(): JsonResponse
    {
        $bankAccounts = SiteSetting::getBankAccounts();

        return response()->json([
            'success' => true,
            'data' => $bankAccounts,
        ]);
    }
}
