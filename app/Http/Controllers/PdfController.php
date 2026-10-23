<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StockTransfer;
use App\Services\PdfInvoiceService;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function invoice(Order $order, PdfInvoiceService $pdfService)
    {
        return $pdfService->generateInvoice($order)->stream("invoice-{$order->order_number}.pdf");
    }

    public function receipt(Order $order, PdfInvoiceService $pdfService)
    {
        return $pdfService->generatePosReceipt($order)->stream("receipt-{$order->order_number}.pdf");
    }

    public function challan(StockTransfer $transfer, PdfInvoiceService $pdfService)
    {
        return $pdfService->generateTransferChallan($transfer)->stream("challan-{$transfer->transfer_number}.pdf");
    }
}
