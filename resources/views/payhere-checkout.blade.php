<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayHere...</title>
</head>
<body onload="document.getElementById('payhere_form').submit()">
    <p style="text-align:center; margin-top: 50px;">Redirecting to PayHere Gateway...</p>
    
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout" id="payhere_form">
        <input type="hidden" name="merchant_id" value="{{ $merchant_id }}">
        
        <!-- Return URL -->
        <input type="hidden" name="return_url" value="{{ route('payment.return') }}">
        <input type="hidden" name="cancel_url" value="{{ route('payment.cancel') }}">
        <input type="hidden" name="notify_url" value="{{ route('payment.notify') }}">
        
        <!-- Order Details -->
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <input type="hidden" name="items" value="Order #{{ $order->id }}">
        <input type="hidden" name="currency" value="{{ $currency }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        
        <!-- Customer Details -->
        <input type="hidden" name="first_name" value="{{ $order->address->first_name ?? 'Guest' }}">
        <input type="hidden" name="last_name" value="{{ $order->address->last_name ?? '' }}">
        <input type="hidden" name="email" value="{{ $order->address->email ?? 'test@example.com' }}">
        <input type="hidden" name="phone" value="{{ $order->address->phone ?? '0777123456' }}">
        <input type="hidden" name="address" value="{{ $order->address->street_address ?? 'Colombo' }}">
        <input type="hidden" name="city" value="{{ $order->address->city ?? 'Colombo' }}">
        <input type="hidden" name="country" value="Sri Lanka">
        
        <!-- Hash -->
        <input type="hidden" name="hash" value="{{ $hash }}">
    </form>
</body>
</html>
