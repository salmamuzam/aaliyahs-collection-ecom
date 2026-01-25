@component('mail::message')
# Order Approved

Dear {{ $order->user->first_name }},

We are happy to inform you that your order has been approved.

**Order Details:**
- **Order ID:** #{{ $order->id }}
- **Status:** Approved
- **Total Price:** LKR {{ number_format($order->grand_total, 2) }}

Thank you for choosing Aaliyah's Collection!

@component('mail::button', ['url' => route('customer.my-orders.show', $order->id)])
View Order Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
