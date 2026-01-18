<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Helper Classes */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-uppercase { text-transform: uppercase; }
        .font-bold { font-weight: bold; }
        .text-teal { color: #134E4A; }
        .text-burgundy { color: #5A1217; }
        .text-white { color: #fff; }
        .bg-teal { background-color: #134E4A; }
        .bg-burgundy { background-color: #5A1217; }
        .border-b { border-bottom: 1px solid #ddd; }
        .mb-2 { margin-bottom: 10px; }
        .mt-4 { margin-top: 20px; }
        .p-2 { padding: 10px; }

        /* Header */
        .header {
            width: 100%;
            margin-bottom: 40px;
        }
        .header td { vertical-align: top; }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #5A1217;
            margin-bottom: 5px;
        }
        .company-info { font-size: 12px; color: #666; line-height: 1.4; }

        .invoice-details { text-align: right; }
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #134E4A;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        /* Billing Info table */
        .info-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .info-table td {
            width: 50%;
            vertical-align: top;
            padding: 10px;
            background-color: #f9fafb;
            border: 1px solid #eee;
        }
        .info-header {
            font-weight: bold;
            color: #134E4A;
            text-transform: uppercase;
            font-size: 11px;
            margin-bottom: 8px;
            border-bottom: 2px solid #5A1217;
            display: inline-block;
            padding-bottom: 3px;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #134E4A;
            color: white;
            padding: 12px;
            text-align: left;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }
        .items-table tr:nth-child(even) { background-color: #fcfcfc; }

        /* Totals */
        .totals-container {
            width: 100%;
            margin-top: 20px;
        }
        .totals-table {
            width: 50%;
            float: right;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 8px 12px;
            text-align: right;
        }
        .totals-label { font-weight: bold; color: #666; }
        .grand-total-row td {
            background-color: #5A1217;
            color: white;
            font-weight: bold;
            font-size: 16px;
            padding: 12px;
        }

        /* Footer */
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <table class="header">
            <tr>
                <td>
                    <div class="logo">Aaliyah's Collection</div>
                    <div class="company-info">
                        Kurunegala, Sri Lanka<br>
                        Email: aaliyahscollection@gmail.com<br>
                        Phone: 0778997783
                    </div>
                </td>
                <td class="invoice-details">
                    <div class="invoice-title">INVOICE</div>
                    <div><strong>Invoice #:</strong> {{ $order->id }}</div>
                    <div><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</div>
                    <div><strong>Status:</strong> <span class="text-uppercase">{{ $order->status }}</span></div>
                </td>
            </tr>
        </table>

        <!-- Billing & Payment Info -->
        <table class="info-table">
            <tr>
                <td>
                    <div class="info-header">Bill To</div>
                    <strong>{{ $order->address->first_name }} {{ $order->address->last_name }}</strong><br>
                    {{ $order->address->street_address }}<br>
                    {{ $order->address->city }} {{ $order->address->postal_code }}<br>
                    {{ $order->address->country ?? 'Sri Lanka' }}<br>
                    {{ $order->address->phone }}
                </td>
                <td>
                    <div class="info-header">Payment Information</div>
                    <strong>Method:</strong> <span class="text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span><br>
                    <strong>Status:</strong> <span class="text-uppercase text-{{ $order->payment_status == 'paid' ? 'teal' : 'burgundy' }}">{{ $order->payment_status }}</span><br>
                    <strong>Currency:</strong> {{ strtoupper($order->currency) }}
                </td>
            </tr>
        </table>

        <!-- Line Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Product</th>
                    <th style="width: 10%; text-align: center;">Qty</th>
                    <th style="width: 20%; text-align: right;">Unit Price</th>
                    <th style="width: 20%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_items as $item)
                <tr>
                    <td>
                        <span class="font-bold">{{ $item->product->name }}</span>
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">LKR {{ number_format($item->unit_amount, 2) }}</td>
                    <td class="text-right font-bold">LKR {{ number_format($item->total_amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-container">
            <table class="totals-table">
                <tr>
                    <td class="totals-label">Subtotal</td>
                    <td>LKR {{ number_format($order->grand_total, 2) }}</td>
                </tr>
                <tr>
                    <td class="totals-label">Shipping</td>
                    <td>Free</td>
                </tr>
                <!-- Tax row if needed -->
                <!--
                <tr>
                    <td class="totals-label">Tax</td>
                    <td>LKR 0.00</td>
                </tr>
                -->
                <tr class="grand-total-row">
                    <td>TOTAL</td>
                    <td>LKR {{ number_format($order->grand_total, 2) }}</td>
                </tr>
            </table>
            <div style="clear: both;"></div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing Aaliyah's Collection!</p>
            <p>If you have any questions concerning this invoice, please contact us at <strong>aaliyahscollection@gmail.com</strong></p>
        </div>
    </div>
</body>
</html>
