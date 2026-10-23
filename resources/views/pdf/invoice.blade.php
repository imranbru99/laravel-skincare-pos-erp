<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>চালান ও ক্যাশ মেমো - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'SolaimanLipi', 'Kalpurush', 'Noto Sans Bengali', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 13px;
            line-height: 1.5;
        }
        .header {
            border-bottom: 2px solid #059669;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .brand-title {
            font-size: 24px;
            font-weight: bold;
            color: #059669;
            margin: 0;
        }
        .brand-subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 4px;
        }
        .badge {
            background: #ecfdf5;
            color: #065f46;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            display: inline-block;
            font-weight: bold;
        }
        .info-grid {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-grid td {
            vertical-align: top;
            padding: 4px;
        }
        .table-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-items th {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        .table-items td {
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            font-size: 12px;
        }
        .total-box {
            width: 40%;
            margin-left: auto;
            border-collapse: collapse;
        }
        .total-box td {
            padding: 4px 8px;
        }
        .grand-total {
            font-size: 15px;
            font-weight: bold;
            color: #059669;
            border-top: 2px solid #059669;
        }
        .footer {
            margin-top: 35px;
            border-top: 1px dashed #d1d5db;
            padding-top: 12px;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="header">
    <table width="100%">
        <tr>
            <td>
                <h1 class="brand-title">গ্লো অ্যান্ড কেয়ার স্কিনকেয়ার</h1>
                <div class="brand-subtitle">১০০% আসল ও সার্টিফাইড কসমেটিকস ও স্কিনকেয়ার ইআরপি</div>
                <div style="font-size: 11px; margin-top: 4px;">শাখা: {{ $order->branch?->name ?? 'সেন্ট্রাল ওয়্যারহাউস, ঢাকা' }} | ফোন: ০১৭১১-০০০০০০</div>
            </td>
            <td align="right" valign="top">
                <span class="badge">ইনভয়েস / ক্যাশ মেমো</span>
                <div style="margin-top: 6px; font-weight: bold;">{{ $order->order_number }}</div>
                <div style="font-size: 11px; color: #6b7280;">তারিখ: {{ $order->created_at->format('d/m/Y h:i A') }}</div>
            </td>
        </tr>
    </table>
</div>

<table class="info-grid">
    <tr>
        <td width="55%">
            <div style="font-weight: bold; color: #374151; margin-bottom: 4px;">গ্রাহকের তথ্য (Customer Details):</div>
            <div>নাম: <strong>{{ $order->customer_name }}</strong></div>
            <div>মোবাইল: <strong>{{ $order->customer_phone }}</strong></div>
            <div>ঠিকানা: {{ $order->delivery_address }}, {{ $order->delivery_city }}</div>
        </td>
        <td width="45%">
            <div style="font-weight: bold; color: #374151; margin-bottom: 4px;">অর্ডার ও কুরিয়ার তথ্য:</div>
            <div>অর্ডার টাইপ: <strong>{{ strtoupper($order->order_type) }}</strong></div>
            <div>পেমেন্ট মেথড: <strong>{{ strtoupper($order->payment_method) }}</strong> ({{ strtoupper($order->payment_status) }})</div>
            @if($order->courier_name)
            <div>কুরিয়ার: <strong>{{ $order->courier_name }}</strong> (ট্র্যাকিং: {{ $order->courier_tracking_code ?? 'N/A' }})</div>
            @endif
        </td>
    </tr>
</table>

<table class="table-items">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="50%">পণ্যের বিবরণ (Item & Brand)</th>
            <th width="15%" style="text-align: right;">মূল্য (Unit Price)</th>
            <th width="10%" style="text-align: center;">পরিমাণ (Qty)</th>
            <th width="20%" style="text-align: right;">মোট (Total ৳)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $index => $item)
        <tr>
            <td align="center">{{ $index + 1 }}</td>
            <td>
                <strong>{{ $item->product_name }}</strong>
                @if($item->product && $item->product->bangla_name)
                    <br><span style="font-size: 11px; color: #6b7280;">{{ $item->product->bangla_name }}</span>
                @endif
            </td>
            <td align="right">৳ {{ number_format($item->unit_price, 2) }}</td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="right">৳ {{ number_format($item->total_price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="total-box">
    <tr>
        <td>সাবটোটাল (Subtotal):</td>
        <td align="right">৳ {{ number_format($order->subtotal, 2) }}</td>
    </tr>
    @if($order->discount > 0)
    <tr>
        <td style="color: #dc2626;">ডিসকাউন্ট (Discount):</td>
        <td align="right" style="color: #dc2626;">- ৳ {{ number_format($order->discount, 2) }}</td>
    </tr>
    @endif
    <tr>
        <td>ডেলিভারি চার্জ (Delivery):</td>
        <td align="right">৳ {{ number_format($order->delivery_charge, 2) }}</td>
    </tr>
    <tr class="grand-total">
        <td>সর্বমোট প্রদেয় (Net Total):</td>
        <td align="right">৳ {{ number_format($order->total_amount, 2) }}</td>
    </tr>
    @if($order->paid_amount > 0)
    <tr>
        <td style="color: #059669;">পরিশোধিত (Paid):</td>
        <td align="right" style="color: #059669;">৳ {{ number_format($order->paid_amount, 2) }}</td>
    </tr>
    @endif
    @if($order->due_amount > 0)
    <tr>
        <td style="font-weight: bold; color: #b91c1c;">বকেয়া / ক্যাশ অন ডেলিভারি (Due COD):</td>
        <td align="right" style="font-weight: bold; color: #b91c1c;">৳ {{ number_format($order->due_amount, 2) }}</td>
    </tr>
    @endif
</table>

<div class="footer">
    <div>আমাদের সাথে কেনাকাটা করার জন্য ধন্যবাদ! ১০০% আসল ত্বকের যত্নের পণ্য ব্যবহারে সুস্থ ত্বক নিশ্চিত করুন।</div>
    <div style="margin-top: 4px;">পণ্য ডেলিভারি প্রাপ্তির ৩ দিনের মধ্যে কোনো অসঙ্গতি থাকলে কাস্টমার কেয়ারে যোগাযোগ করুন।</div>
</div>

</body>
</html>
