<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $status = $request->query('status');

        $query = Customer::query();

        if ($status !== null) {
            if (!in_array($status, ['active', 'inactive'], true)) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "errors" => [
                        "status" => ["The selected status is invalid."],
                    ],
                ], 422);
            }
            $query->where('status', $status === 'active');
        }
        $customers = $query->latest()->get();

        return response()->json([
            "success" => true,
            "message" => "Customers retrieved successfully",
            "data" => $customers,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'customer_id' => 'required|string|unique:customers,customer_id',
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $customer = Customer::query()->create($data);

        return response()->json([
            "success" => true,
            "message" => "Customer created successfully",
            "data" => $customer,
        ], 201);
    }

    public function show(int $customer): JsonResponse
    {
        $customer = Customer::query()->find($customer);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Customer retrieved successfully",
            "data" => $customer,
        ]);
    }

    public function update(Request $request, int $customer): JsonResponse
    {
        $customer = Customer::query()->find($customer);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
            ], 404);
        }

        $data = $request->validate([
            'customer_id' => 'required|string|unique:customers,customer_id,' . $customer->id,
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $customer->update($data);

        return response()->json([
            "success" => true,
            "message" => "Customer updated successfully",
            "data" => $customer,
        ]);
    }

    public function destroy(int $customer): JsonResponse
    {
        $customer = Customer::query()->find($customer);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
            ], 404);
        }

        $customer->delete();

        return response()->json([
            "success" => true,
            "message" => "Customer deleted successfully",
        ]);
    }

    public function activate(int $customer): JsonResponse
    {
        $customer = Customer::query()->find($customer);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
            ], 404);
        }

        $customer->update(['status' => true]);

        return response()->json([
            "success" => true,
            "message" => "Customer activated successfully",
            "data" => $customer,
        ]);
    }

    public function deactivate(int $customer): JsonResponse
    {
        $customer = Customer::query()->find($customer);

        if (!$customer) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
            ], 404);
        }

        $customer->update(['status' => false]);

        return response()->json([
            "success" => true,
            "message" => "Customer deactivated successfully",
            "data" => $customer,
        ]);
    }
}
