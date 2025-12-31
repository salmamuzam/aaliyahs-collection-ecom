@component('mail::message')
# Order Cancelled

Dear {{ $order->user->first_name }},

We regret to inform you that your order #{{ $order->id }} has been cancelled.

**Order Details:**
- **Order ID:** #{{ $order->id }}
- **Status:** Cancelled
- **Total Price:** LKR {{ number_format($order->grand_total, 2) }}

If you have any questions regarding this cancellation, please contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
