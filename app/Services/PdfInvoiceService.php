<?php

namespace App\Services;

use App\Models\Order;
use App\Models\StockTransfer;
use ImranDev\UnicodePdf\Facades\UnicodePdf;

class PdfInvoiceService
{
    /**
     * Generate Order Invoice PDF
     */
    public function generateInvoice(Order $order)
    {
        $order->load(['items.product', 'branch', 'customer']);

        return UnicodePdf::loadView('pdf.invoice', ['order' => $order])
            ->preset('bengali')
            ->name("invoice-{$order->order_number}.pdf");
    }

    /**
     * Generate POS Thermal Receipt (80mm width)
     */
    public function generatePosReceipt(Order $order)
    {
        $order->load(['items.product', 'branch', 'user']);

        return UnicodePdf::loadView('pdf.pos-receipt', ['order' => $order])
            ->preset('bengali')
            ->setPaper([0, 0, 226.77, 600], 'portrait') // 80mm roll width
            ->name("receipt-{$order->order_number}.pdf");
    }

    /**
     * Generate Inter-branch Stock Transfer Challan PDF
     */
    public function generateTransferChallan(StockTransfer $transfer)
    {
        $transfer->load(['items.product', 'fromBranch', 'toBranch', 'creator']);

        return UnicodePdf::loadView('pdf.challan', ['transfer' => $transfer])
            ->preset('bengali')
            ->name("challan-{$transfer->transfer_number}.pdf");
    }
}
