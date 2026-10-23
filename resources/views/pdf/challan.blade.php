<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>স্টক ট্রান্সফার চালান - {{ $transfer->transfer_number }}</title>
    <style>
        body {
            font-family: 'SolaimanLipi', 'Noto Sans Bengali', Arial, sans-serif;
            margin: 0;
            padding: 24px;
            font-size: 13px;
            color: #1f2937;
        }
        .header {
            border-bottom: 2px solid #2563eb;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .title { font-size: 22px; font-weight: bold; color: #1e40af; margin: 0; }
        .meta-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .meta-table td { padding: 6px; }
        .box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; }
        .items-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .items-table th { background: #2563eb; color: #fff; padding: 8px 10px; text-align: left; font-size: 12px; }
        .items-table td { border: 1px solid #e2e8f0; padding: 8px 10px; font-size: 12px; }
        .signature-table { width: 100%; margin-top: 60px; text-align: center; }
        .signature-table td { width: 33%; vertical-align: top; }
        .sign-line { border-top: 1px dashed #64748b; margin: 0 20px; padding-top: 6px; font-size: 12px; }
    </style>
</head>
<body>

<div class="header">
    <table width="100%">
        <tr>
            <td>
                <h1 class="title">গ্লো অ্যান্ড কেয়ার স্কিনকেয়ার</h1>
                <div style="font-size: 13px; color: #475569; margin-top: 2px;">আন্তঃশাখা স্টক ট্রান্সফার চালান (Internal Stock Transfer Challan)</div>
            </td>
            <td align="right">
                <div style="font-size: 16px; font-weight: bold; color: #1e40af;">চালান নং: {{ $transfer->transfer_number }}</div>
                <div style="font-size: 12px; color: #64748b;">তারিখ: {{ $transfer->created_at->format('d/m/Y h:i A') }}</div>
            </td>
        </tr>
    </table>
</div>

<table class="meta-table">
    <tr>
        <td width="50%">
            <div class="box">
                <strong style="color: #1e40af;">প্রেরক শাখা (Dispatching Branch):</strong>
                <div>{{ $transfer->fromBranch->name }}</div>
                <div style="font-size: 11px; color: #64748b;">{{ $transfer->fromBranch->address }}</div>
            </div>
        </td>
        <td width="50%">
            <div class="box">
                <strong style="color: #1e40af;">প্রাপক শাখা (Receiving Branch):</strong>
                <div>{{ $transfer->toBranch->name }}</div>
                <div style="font-size: 11px; color: #64748b;">{{ $transfer->toBranch->address }}</div>
            </div>
        </td>
    </tr>
</table>

<table class="items-table">
    <thead>
        <tr>
            <th width="8%">#</th>
            <th width="45%">পণ্যের নাম ও এসকেইউ</th>
            <th width="17%" style="text-align: center;">চাহিদা পরিমাণ (Requested)</th>
            <th width="15%" style="text-align: center;">প্রেরিত পরিমাণ (Transferred)</th>
            <th width="15%" style="text-align: center;">প্রাপ্ত পরিমাণ (Received)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transfer->items as $index => $item)
        <tr>
            <td align="center">{{ $index + 1 }}</td>
            <td>
                <strong>{{ $item->product->name }}</strong>
                <div style="font-size: 11px; color: #64748b;">SKU: {{ $item->product->sku }} | বারকোড: {{ $item->product->barcode ?? 'N/A' }}</div>
            </td>
            <td align="center">{{ $item->quantity_requested }} টি</td>
            <td align="center">{{ $item->quantity_transferred }} টি</td>
            <td align="center">{{ $item->quantity_received }} টি</td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($transfer->notes)
<div style="margin-top: 15px; font-size: 12px; background: #fffbeb; border: 1px solid #fef3c7; padding: 8px; border-radius: 4px;">
    <strong>বিশেষ দ্রষ্টব্য / নোট:</strong> {{ $transfer->notes }}
</div>
@endif

<table class="signature-table">
    <tr>
        <td>
            <div class="sign-line">প্রেরকের স্বাক্ষর<br><span style="font-size: 10px; color: #64748b;">(প্রস্তুতকারী)</span></div>
        </td>
        <td>
            <div class="sign-line">অনুমোদনকারীর স্বাক্ষর<br><span style="font-size: 10px; color: #64748b;">(ওয়্যারহাউস ইনচার্জ)</span></div>
        </td>
        <td>
            <div class="sign-line">গ্রহীতার স্বাক্ষর<br><span style="font-size: 10px; color: #64748b;">(শাখা ম্যানেজার)</span></div>
        </td>
    </tr>
</table>

</body>
</html>
