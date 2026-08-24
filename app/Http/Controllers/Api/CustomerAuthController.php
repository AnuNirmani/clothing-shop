<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CustomerWelcomeMail;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CustomerAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $customer = Customer::where('email', $validated['email'])->first();

        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'created_at' => $customer->created_at,
            ],
        ]);
    }

    public function showByEmail(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $customer = Customer::where('email', $validated['email'])->first();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'created_at' => $customer->created_at,
            ],
        ]);
    }

    public function show(Customer $customer): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'created_at' => $customer->created_at,
            ],
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $customer = Customer::create([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $mailSent = true;
        $mailMessage = 'A welcome email has been sent.';

        try {
            Mail::to($customer->email)->send(new CustomerWelcomeMail($customer));
        } catch (Throwable $exception) {
            $mailSent = false;
            $mailMessage = 'Account created, but we could not send the welcome email right now.';

            Log::warning('Customer welcome email failed', [
                'customer_id' => $customer->id,
                'email' => $customer->email,
                'error' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully. ' . $mailMessage,
            'mail_sent' => $mailSent,
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
            ],
        ], 201);
    }
}
