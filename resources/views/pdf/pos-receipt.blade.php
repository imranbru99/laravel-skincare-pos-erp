<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>POS Receipt - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'SolaimanLipi', 'Noto Sans Bengali', monospace, sans-serif;
            margin: 0;
            padding: 8px;
            font-size: 11px;
            color: #000;
            width: 280px;
            margin: auto;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .divider { border-bottom: 1px dashed #000; margin: 6px 0; }
        .double-divider { border-bottom: 2px solid #000; margin: 6px 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 2px 0; font-size: 11px; }
        .store-name { font-size: 15px; font-weight: bold; }
    </style>
</head>
<body>

<div class="text-center">
    <div class="store-name">GLOW & CARE SKINCARE</div>
    <div>{{ $order->branch?->name ?? 'Dhaka Main Outlet' }}</div>
    <div>{{ $order->branch?->address ?? 'Banani 11, Dhaka' }}</div>
    <div>হটলাইন: 01700-000000</div>
</div>

<div class="divider"></div>

<div>রসিদ নং: <span class="bold">{{ $order->order_number }}</span></div>
<div>তারিখ: {{ $order->created_at->format('d-m-Y h:i A') }}</div>
<div>ক্যাশিয়ার: {{ $order->user?->name ?? 'Counter 1' }}</div>
<div>গ্রাহক: {{ $order->customer_name }} ({{ $order->customer_phone }})</div>

<div class="divider"></div>

<table>
    <thead>
        <tr>
            <th align="left">আইটেম</th>
            <th align="center">পরিমাণ</th>
            <th align="right">মূল্য</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td colspan="3" class="bold">{{ $item->product_name }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center">{{ $item->quantity }} x {{ number_format($item->unit_price, 0) }}</td>
            <td align="right">{{ number_format($item->total_price, 0) }}৳</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="divider"></div>

<table>
    <tr>
        <td>সাবটোটাল:</td>
        <td align="right">{{ number_format($order->subtotal, 0) }}৳</td>
    </tr>
    @if($order->discount > 0)
    <tr>
        <td>ডিসকাউন্ট:</td>
        <td align="right">-{{ number_format($order->discount, 0) }}৳</td>
    </tr>
    @endif
    <tr class="bold" style="font-size: 12px;">
        <td>মোট প্রদেয়:</td>
        <td align="right">{{ number_format($order->total_amount, 0) }}৳</td>
    </tr>
    <tr>
        <td>পরিশোধ ({{ strtoupper($order->payment_method) }}):</td>
        <td align="right">{{ number_format($order->paid_amount, 0) }}৳</td>
    </tr>
    @if($order->due_amount > 0)
    <tr class="bold">
        <td>বকেয়া:</td>
        <td align="right">{{ number_format($order->due_amount, 0) }}৳</td>
    </tr>
    @endif
</table>

<div class="double-divider"></div>

<div class="text-center" style="font-size: 10px;">
    <div>ধন্যবাদ আবার আসবেন!</div>
    <div>বিকাশ/নগদ/কার্ড প্রযোজ্য</div>
    <div>সিল করা পণ্য ফেরতযোগ্য নয়</div>
</div>

</body>
</html>
