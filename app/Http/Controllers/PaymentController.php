<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function placeOrder(Request $request)
    {
        return response()->json(['message' => 'placeOrder stub']);
    }

    public function order_track(Request $request)
    {
        return response()->json(['message' => 'order_track stub']);
    }

    public function createOrder(Request $request)
    {
        return response()->json(['message' => 'createOrder stub']);
    }

    public function verifyPayment(Request $request)
    {
        return response()->json(['message' => 'verifyPayment stub']);
    }

    public function handleWebhook(Request $request)
    {
        return response()->json(['message' => 'handleWebhook stub']);
    }
}
