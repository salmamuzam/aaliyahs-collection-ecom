<x-mail::message>
# Order Received!

Thank you for your order. We have received your order #{{ $order->id }} and it is currently awaiting approval from our team.

We will notify you once your order has been approved and moved to processing.

<x-mail::button :url="$url">
View Order Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
