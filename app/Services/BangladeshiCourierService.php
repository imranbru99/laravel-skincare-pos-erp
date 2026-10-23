<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BangladeshiCourierService
{
    /**
     * Calculate delivery fee based on zone
     */
    public static function calculateDeliveryFee(string $zone): float
    {
        return match ($zone) {
            'inside_dhaka' => 60.00,
            'sub_dhaka' => 100.00,
            'outside_dhaka' => 130.00,
            default => 60.00,
        };
    }

    /**
     * Create parcel in Steadfast Courier
     */
    public function bookSteadfast(Order $order): array
    {
        $apiKey = config('services.steadfast.api_key', 'demo_steadfast_key');
        $secretKey = config('services.steadfast.secret_key', 'demo_steadfast_secret');
        $baseUrl = config('services.steadfast.base_url', 'https://portal.steadfast.com.bd/api/v1');

        $payload = [
            'invoice' => $order->order_number,
            'recipient_name' => $order->customer_name,
            'recipient_phone' => $order->customer_phone,
            'recipient_address' => $order->delivery_address . ', ' . $order->delivery_city,
            'cod_amount' => $order->payment_status === 'paid' ? 0 : (float) $order->due_amount,
            'note' => $order->notes ?? 'Handle with care - Skincare cosmetics',
        ];

        try {
            // If demo credentials or simulation mode:
            if ($apiKey === 'demo_steadfast_key') {
                $mockTrackingCode = 'SF' . rand(10000000, 99999999);
                $mockConsignmentId = (string) rand(100000, 999999);

                $order->update([
                    'courier_name' => 'Steadfast',
                    'courier_tracking_code' => $mockTrackingCode,
                    'courier_consignment_id' => $mockConsignmentId,
                    'courier_status' => 'in_review',
                    'status' => 'packaged',
                ]);

                return [
                    'success' => true,
                    'consignment_id' => $mockConsignmentId,
                    'tracking_code' => $mockTrackingCode,
                    'tracking_url' => "https://steadfast.com.bd/t/{$mockTrackingCode}",
                    'message' => 'Parcel booked successfully with Steadfast Courier (Demo/Simulated)',
                ];
            }

            $response = Http::withHeaders([
                'Api-Key' => $apiKey,
                'Secret-Key' => $secretKey,
                'Content-Type' => 'application/json',
            ])->post("{$baseUrl}/create_order", $payload);

            if ($response->successful()) {
                $data = $response->json();
                $trackingCode = $data['consignment']['tracking_code'] ?? null;
                $consignmentId = (string) ($data['consignment']['consignment_id'] ?? '');

                $order->update([
                    'courier_name' => 'Steadfast',
                    'courier_tracking_code' => $trackingCode,
                    'courier_consignment_id' => $consignmentId,
                    'courier_status' => 'in_review',
                    'status' => 'packaged',
                ]);

                return [
                    'success' => true,
                    'consignment_id' => $consignmentId,
                    'tracking_code' => $trackingCode,
                    'tracking_url' => "https://steadfast.com.bd/t/{$trackingCode}",
                ];
            }

            Log::error('Steadfast booking failed', ['response' => $response->body()]);
            return ['success' => false, 'error' => $response->body()];
        } catch (\Throwable $e) {
            Log::error('Courier exception: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Check Steadfast delivery status
     */
    public function checkStatus(Order $order): array
    {
        if (empty($order->courier_tracking_code)) {
            return ['status' => 'unknown', 'message' => 'No courier tracking code found.'];
        }

        // Simulated progression for demo
        $statuses = ['in_review', 'picked_up', 'in_transit', 'delivered'];
        $currentIdx = array_search($order->courier_status, $statuses);
        $nextStatus = $currentIdx !== false && $currentIdx < count($statuses) - 1 ? $statuses[$currentIdx + 1] : ($order->courier_status ?: 'in_transit');

        $order->update([
            'courier_status' => $nextStatus,
            'status' => $nextStatus === 'delivered' ? 'delivered' : 'in_transit',
        ]);

        return [
            'tracking_code' => $order->courier_tracking_code,
            'status' => $nextStatus,
            'tracking_url' => "https://steadfast.com.bd/t/{$order->courier_tracking_code}",
        ];
    }
}
