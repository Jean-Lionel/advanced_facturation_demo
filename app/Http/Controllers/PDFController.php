<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    //

    public function invoinces(Request $request)
    {
        $pdf = PDF::loadView('pdf.invoice',[
            'data' => "Je suis un Milliardaire "
        ] );
        return $pdf->download('invoice.pdf');
    }
}
