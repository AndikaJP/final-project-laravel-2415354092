<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Get All Data
     */
    public function index(): JsonResponse
    {
        $subscriptions = Subscription::with([
            'customer',
            'service'
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'All subscriptions retrieved successfully',
            'data' => $subscriptions,
        ]);
    }

    /**
     * Store Data
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive,trial,isolir,dismantled',
        ]);

        $subscription = Subscription::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully',
            'data' => [
                'customer_id' => $subscription->customer_id,
                'service_id' => $subscription->service_id,
                'start_date' => $subscription->start_date,
                'end_date' => $subscription->end_date,
                'status' => $subscription->status,
            ],
        ], 201);
    }

    /**
     * Get Data by ID
     */
    public function show(int $id): JsonResponse
    {
        $subscription = Subscription::with([
            'customer',
            'service'
        ]);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Subscription retrieved successfully',
            'data' => $subscription,
        ]);
    }

    /**
     * Get All Data by Status
     */
    public function getByStatus(string $status): JsonResponse
    {
        if (
            !in_array($status, [
                'active',
                'inactive',
                'trial',
                'isolir',
                'dismantled'
            ])
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid status',
            ], 422);
        }

        $subscriptions = Subscription::query()
            ->select([
                'customer_id',
                'service_id',
                'start_date',
                'end_date',
                'status',
            ])
            ->where('status', $status)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Subscriptions retrieved successfully',
            'data' => $subscriptions,
        ]);
    }

    /**
     * Change Status
     */
    public function changeStatus(Request $request, int $id): JsonResponse
    {
        $subscription = Subscription::find($id);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
            ], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:active,inactive,trial,isolir,dismantled',
        ]);

        $subscription->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription status updated successfully',
            'data' => [
                'customer_id' => $subscription->customer_id,
                'service_id' => $subscription->service_id,
                'start_date' => $subscription->start_date,
                'end_date' => $subscription->end_date,
                'status' => $subscription->status,
            ],
        ]);
    }
}