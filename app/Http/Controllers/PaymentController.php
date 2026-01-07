<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function payhereCheckout(Order $order)
    {
        // Terse way to handle checkout initialization
        return view('payment.payhere', compact('order'));
    }

    public function return(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            if ($order = Order::find(session()->pull('current_order_id'))) {
                $order->update(['payment_status' => 'paid']);
                return redirect()->route('success', $order)->with('success', 'Verified by PayPal');
            }
        }

        return redirect()->route('cancel')->with('error', 'Payment failed');
    }

    public function cancel()
    {
        return redirect()->route('cart')->with('error', 'Payment Cancelled');
    }

    public function success(Request $request, ?Order $order = null)
    {
        // Resolve order from binding or fallback to session
        $order = $order ?? Order::find(session()->pull('current_order_id')) ?? Order::find($request->order_id);

        if (!$order) {
            return redirect()->route('shop');
        }

        // Terse update for status
        $order->when($request->has('session_id'), fn($o) => $o->update(['payment_status' => 'paid']));

        return view('livewire.guest.success-page', compact('order'));
    }
}
