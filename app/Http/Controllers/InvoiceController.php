<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate(Sale $sale)
    {
        $pdf = PDF::loadView('invoices.template', compact('sale'));
        
        return $pdf->download("invoice-{$sale->id}.pdf");
    }
} 