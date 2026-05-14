<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    protected $stripe;

    public function __construct(StripeClient $stripeClient) {
        $this->stripe = $stripeClient;
    }

    public function initiate(Request $request)
    {
        // 1. Create the Stripe Checkout Session
        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
        // ADD THIS: Collect address automatically on the Stripe page
        'billing_address_collection' => 'required',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                    'name' => 'Advanced Laravel Guide',
                    // ADD THIS: Description helps with compliance
                    'description' => 'Digital access to professional development content',
                    ],
                    'unit_amount' => 1000, // Amount in paise (10.00 INR)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),

        // ADD THIS: Passing a customer email helps pre-fill and satisfy identity checks
        'customer_email' => auth()->user()->email ?? 'guest@example.com',
        ]);

        // 2. Redirect to Stripe's Hosted page immediately
        return redirect($session->url);
    }
    /*
    public function callback(Request $request)
    {

    }

    public function webhook(Request $request)
    {

    }*/

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('/product/test-product')->with('error', 'No session ID provided.');
        }

        // Retrieve session to verify payment was actually successful
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            // SUCCESS: Update your DB (e.g., $order->update(['status' => 'paid']))
            return "Payment Successful! Transaction ID: " . $session->payment_intent;
        }

        return "Payment failed or was pended.";
    }

    public function cancel()
    {
        return "Payment was cancelled by the user.";
    }

    public function index() {
        return view('payment.index');
    }

    public function refund($paymentIntentId)
    {
        try {
            $refund = $this->stripe->refunds->create([
                'payment_intent' => $paymentIntentId,
                 'amount' => 500, // Optional: Partial refund in paise (e.g., ₹50.00)
            ]);

            return response()->json([
                'status' => 'success',
                'refund_id' => $refund->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
