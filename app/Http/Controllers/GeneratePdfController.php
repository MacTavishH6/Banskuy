<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use PDF;

class GeneratePdfController extends Controller
{

    public function pdfDownload(Request $request)
    {

        $data =
            [
            'DonaterName' => $request->DonaterName,
            'DonationType' => $request->DonationType,
            'DonationDate' => $request->DonationDate,
            'DonationTItle' => $request->DonationTItle
            ];
        $pdf = PDF::loadView('pdf_download', $data);

        return $pdf->download('Sertifikat_'.Carbon::now().'_'.$request->DonaterName.'.pdf');
    }
}