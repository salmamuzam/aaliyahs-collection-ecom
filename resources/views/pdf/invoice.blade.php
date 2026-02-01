<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        :root {
            --bg-clr: #004D61;
            --white: #fff;
            --invoice-left-bg: #e7e7e9;
            --primary-clr: #2f2929;
            --secondary-clr: #004D61;
        }

        body {
            background: #fff; /* Changed from variable for PDF rendering */
            font-family: "Helvetica", "Arial", sans-serif;
            font-size: 12px;
            line-height: 20px;
            color: #2f2929;
            margin: 0;
            padding: 0;
        }

        .main_title {
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            color: #004D61;
        }

        .p_title {
            font-weight: 700;
            font-size: 14px;
            margin-top: 10px;
        }

        .p_title > span {
            font-weight: 400;
            font-size: 12px;
        }

        .text_right {
            text-align: right;
        }

        .text_center {
            text-align: center;
        }

        .divider {
            width: 75px;
            height: 3px;
            background: #004D61;
            margin: 5px 0;
        }

        .invoice {
            width: 100%;
            height: auto;
            background: #fff;
            margin: 0;
            display: table; /* Using table for layout instead of flex */
        }

        .invoice_left {
            display: table-cell;
            width: 35%;
            background: #e7e7e9;
            padding: 40px 30px;
            vertical-align: top;
        }

        .invoice_right {
            display: table-cell;
            width: 65%;
            padding: 40px 30px;
            vertical-align: top;
        }

        .section_margin {
            margin-bottom: 40px;
        }

        .logo_text {
            font-size: 28px;
            line-height: 32px;
            color: #004D61;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 32px;
            line-height: 38px;
            color: #004D61;
            margin: 0;
        }

        /* table styling */
        .i_table {
            width: 100%;
            border-collapse: collapse;
        }

        .i_table_head {
            background: #e7e7e9;
        }

        .i_table th {
            padding: 10px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
        }

        .i_table td {
            padding: 10px;
            border-bottom: 1px solid #e7e7e9;
        }

        .i_table_foot td {
            padding: 5px 10px;
            border: 0;
        }

        .grand_total_wrap {
            margin-top: 10px;
            background: #e7e7e9;
        }

        .grand_total_wrap td {
            font-weight: 700;
            font-size: 16px;
            padding: 10px;
        }

        .terms {
            margin-top: 40px;
        }

        .w_55 { width: 55%; }
        .w_15 { width: 15%; }
        .w_50 { width: 50%; }

    </style>
</head>
<body>
    <div class="invoice">
        <!-- LEFT COLUMN -->
        <div class="invoice_left">
            <div class="logo_text">
                Aaliyah's Collection
            </div>

            <div class="section_margin">
                <div class="main_title">
                    Invoice To
                    <div class="divider"></div>
                </div>
                <div class="p_title">
                    {{ $address->first_name }} {{ $address->last_name }}<br>
                    <span>Customer</span>
                </div>
                <div class="p_title">
                    <p>{{ $address->street_address }}</p>
                    <p>{{ $address->city }}, {{ $address->country ?? 'Sri Lanka' }}</p>
                    <p>{{ $address->phone }}</p>
                </div>
            </div>

            <div class="section_margin">
                <div class="main_title">
                    Invoice details
                    <div class="divider"></div>
                </div>
                <div class="p_title">
                    Invoice No:<br>
                    <span>#{{ $order->id }}</span>
                </div>
                <div class="p_title">
                    Invoice Date:<br>
                    <span>{{ $order->created_at->format('d M Y') }}</span>
                </div>
            </div>

            <div class="section_margin">
                <div class="main_title">
                    Payment Method
                    <div class="divider"></div>
                </div>
                <div class="p_title">
                    Method:<br>
                    <span>{{ strtolower($order->payment_method) == 'cod' ? 'Cash on Delivery' : (strtolower($order->payment_method) == 'stripe' ? 'Stripe' : strtoupper($order->payment_method)) }}</span>
                </div>
                <div class="p_title">
                    Status:<br>
                    <span>{{ strtoupper($order->payment_status) }}</span>
                </div>
            </div>

            <div class="section_margin">
                <div class="main_title">
                    Amount
                    <div class="divider"></div>
                </div>
                <div class="p_title">
                    Amount:<br>
                    <span>LKR {{ number_format($order->grand_total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="invoice_right">
            <div class="section_margin">
                <div class="title">
                    <h1>INVOICE</h1>
                    <div class="divider" style="width: 120px;"></div>
                </div>
            </div>

            <div class="i_table">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead class="i_table_head">
                        <tr>
                            <th class="w_55">Description</th>
                            <th class="w_15 text_center">Qty</th>
                            <th class="w_15 text_center">Price</th>
                            <th class="w_15 text_right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_items as $item)
                        <tr>
                            <td>
                                <p style="margin:0; font-weight:700;">{{ $item->product->name }}</p>
                            </td>
                            <td class="text_center">{{ $item->quantity }}</td>
                            <td class="text_center">LKR {{ number_format($item->unit_amount, 2) }}</td>
                            <td class="text_right">LKR {{ number_format($item->total_amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <tr class="i_table_foot">
                        <td class="w_50">Sub Total</td>
                        <td class="w_50 text_right">LKR {{ number_format($order->grand_total, 2) }}</td>
                    </tr>
                    <tr class="i_table_foot">
                        <td class="w_50">Shipping</td>
                        <td class="w_50 text_right">Free</td>
                    </tr>
                    <tr class="grand_total_wrap">
                        <td class="w_50">GRAND TOTAL:</td>
                        <td class="w_50 text_right">LKR {{ number_format($order->grand_total, 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="terms">
                <div class="main_title">
                    Terms and Conditions
                    <div class="divider"></div>
                </div>
                <p style="font-size: 10px; color: #666;">
                    Thank you for shopping with Aaliyah's Collection. Please note that all sales are final. 
                    If you have any questions regarding your order, please contact us at aaliyahscollection@gmail.com.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
