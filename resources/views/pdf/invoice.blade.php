<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        @page { margin: 0px; }
        body {
            font-family: 'Times New Roman', serif;
            color: #1A1A1A; 
            font-size: 15px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #F3EDE8; /* Brand Beige */
        }
        .invoice-border {
            border: 4px solid #000;
            padding: 30px;
            margin: 20px;
            min-height: 960px; /* Frame the A4 page */
            background-color: transparent;
        }

        /* Helpers */
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        .float-left { float: left; }
        .float-right { float: right; }
        .w-50 { width: 50%; }
        .text-right { text-align: right; }
        .text-bold { font-weight: 700; }
        
        /* Brand Colors */
        .text-teal { color: #004D61; }
        .text-burgundy { color: #822659; }

        /* Header */
        .header { margin-bottom: 40px; }
        .logo h1 {
            font-family: 'Times New Roman', serif;
            font-size: 32px;
            margin: 0;
            color: #822659;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .main-title {
            font-family: 'Times New Roman', serif;
            font-size: 42px;
            font-weight: 700;
            margin: 0;
            color: #111;
            text-align: right;
            text-transform: uppercase;
        }
        .meta-line {
            margin-top: 8px; /* More space */
            text-align: right;
            font-size: 14px; /* Bigger */
            color: #555;
        }

        /* Address & Info Section */
        .address-container { margin-bottom: 40px; } /* More buffer */
        .section-title {
            font-size: 12px;
            text-transform: uppercase;
            color: #004D61;
            font-weight: 700;
            margin-bottom: 8px; /* More space below title */
            letter-spacing: 0.5px;
        }
        .info-text {
            color: #333;
            line-height: 1.8; /* Extra line height for addresses */
            margin-bottom: 15px;
        }

        /* Bordered Container */
        .bordered-container {
            border: 1px solid #000;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: transparent; /* Match page bg */
            color: #3E5641; /* Brand Green */
            font-weight: 700;
            text-align: left;
            padding: 15px; /* More padding */
            border-bottom: 1px solid #000;
            font-size: 12px;
            text-transform: uppercase;
        }
        td {
            padding: 15px; /* More cell padding */
            border-bottom: 1px solid #000;
            color: #333;
            vertical-align: top;
        }
        
        /* Bottom Section */
        .bottom-left {
            width: 55%;
            padding: 25px; /* More padding */
            vertical-align: top;
            border-right: 1px solid #000;
        }
        .bottom-right {
            width: 45%;
            padding: 0;
            vertical-align: top;
        }
        
        .grand-total-row td {
            background-color: #822659; /* Brand Burgundy */
            color: #fff;
            font-weight: 700;
            font-size: 16px; /* Bigger total */
            border: none;
            padding: 20px 15px; /* Beefier total row */
        }

        /* Footer */
        .footer {
            margin-top: 60px;
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 30px;
        }
        .footer p { margin: 0 0 5px 0; font-size: 16px; color: #444; } /* Bigger contact */
        .footer a { color: #004D61; text-decoration: none; font-weight: bold; }
        .footer .small { font-size: 14px; color: #666; margin-top: 8px; } /* Bigger 'Thank you' */

    </style>
</head>
<body>
    <div class="invoice-border">

    <!-- Header -->
    <div class="header clearfix">
        <div class="float-left w-50 logo">
            <h1>Aaliyah's Collection</h1>
        </div>
        <div class="float-right w-50">
            <h2 class="main-title">Invoice</h2>
            <div class="meta-line">
                Invoice No: <span class="text-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="meta-line">
                Date: <span class="text-bold">{{ $order->created_at->format('F d, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Address Section -->
    <div class="address-container clearfix">
        <div class="float-left w-50">
            <div class="section-title">Shipping Information</div>
            <div class="info-text">
                <span class="text-bold">{{ $address->full_name }}</span><br>
                {{ $address->street_address }}, {{ $address->city }}, {{ $address->postal_code }}, {{ $address->country }}<br>
                {{ $order->user->email }}
            </div>
            
            <!-- Order Status Removed -->
        </div>
        
        <div class="float-right w-50 text-right">
            <div class="section-title">Pay To</div>
            <div class="info-text">
                <span class="text-bold">Aaliyah's Collection</span><br>
                Colombo 15, Sri Lanka<br>
                aaliyahscollection@gmail.com
            </div>
        </div>
    </div>

    <!-- Main Content Bordered Box -->
    <div class="bordered-container">
        <!-- Items Table -->
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th width="40%">Item</th>
                    <th width="15%">Price</th>
                    <th width="15%" class="text-center">Qty</th>
                    <th width="30%" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_items as $item)
                <tr style="{{ $loop->last ? '' : 'border-bottom: 1px solid #000;' }}">
                    <td style="padding: 15px; {{ $loop->last ? 'border-bottom: none;' : 'border-bottom: 1px solid #000;' }}">
                        <span class="text-bold">{{ $item->product->name }}</span><br>
                        <span style="font-size: 11px; color: #666;">{{ $item->product->category->name }}</span>
                    </td>
                    <td style="padding: 15px; {{ $loop->last ? 'border-bottom: none;' : 'border-bottom: 1px solid #000;' }}">{{ number_format($item->unit_amount, 2) }}</td>
                    <td class="text-center" style="padding: 15px; {{ $loop->last ? 'border-bottom: none;' : 'border-bottom: 1px solid #000;' }}">{{ $item->quantity }}</td>
                    <td class="text-right" style="padding: 15px; {{ $loop->last ? 'border-bottom: none;' : 'border-bottom: 1px solid #000;' }}">{{ number_format($item->total_amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bottom Split Section -->
        <table style="width: 100%; border-top: 1px solid #000;">
            <tr>
                <!-- Left: Payment Info -->
                <td class="bottom-left" style="border-right: 1px solid #000; border-bottom: none;">
                    <div class="section-title">Payment Details</div>
                    <p style="margin: 0 0 5px 0; color: #333;">
                        Method: <span class="text-bold">{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Card' }}</span>
                    </p>
                    <p style="margin: 0; color: #333;">
                        Status: <span style="background-color: #3E5641; color: #fff; padding: 3px 8px; font-weight: bold; border-radius: 4px; font-size: 11px;">{{ strtoupper($order->payment_status) }}</span>
                    </p>
                </td>

                <!-- Right: Totals -->
                <td class="bottom-right" style="padding: 0; border-bottom: none; vertical-align: bottom;">
                    <table style="width: 100%; margin: 0; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 10px 20px; border-bottom: 1px solid #000;">Subtotal</td>
                            <td style="padding: 10px 20px; border-bottom: 1px solid #000;" class="text-right">{{ number_format($order->grand_total, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 20px; border-bottom: 1px solid #000;">Shipping</td>
                            <td style="padding: 10px 20px; border-bottom: 1px solid #000; color: #3E5641; font-weight: bold;" class="text-right">Free</td>
                        </tr>
                        <tr class="grand-total-row">
                            <td style="padding: 15px 20px;">Total</td>
                            <td style="padding: 15px 20px;" class="text-right">LKR {{ number_format($order->grand_total, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Need help? Contact us at <a href="mailto:aaliyahscollection@gmail.com">aaliyahscollection@gmail.com</a></p>
        <p class="small">Thank you for shopping with Aaliyah's Collection!</p>
    </div>

    </div>
</body>
</html>
