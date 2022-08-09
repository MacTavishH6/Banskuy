<?php

namespace App\Http\Controllers;

use App\Models\DonationTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use PDF;
use Illuminate\Support\Facades\Auth;

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

        return $pdf->download('Sertifikat_' . Carbon::now() . '_' . $request->DonaterName . '.pdf');
    }

    public function pdfRecapDownload(Request $request)
    {
        $data = DonationTransaction::where('FoundationID', $request->id)->where('ApprovalStatusID', '!=', '6')->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->with('Foundation')->with('User')->orderBy('TransactionDate', 'DESC')->orderBy('created_at', 'DESC')->get();
        //dd($data);
        $data = $data->filter(function ($x) use ($request) {
            if ($request->keyword) $x = (str_contains($x->DonationDescriptionName, $request->keyword) || str_contains($x->DonationTypeDetail->DonationType->DonationTypeName, $request->keyword) || str_contains($x->Foundation->FoundationName, $request->keyword)) ? $x : [];
            // echo ($x);
            // // echo ($x->ApprovalStatus);
            // return;
            if ($x && $request->donationStatus) $x = ($x->ApprovalStatus->ApprovalStatusID == $request->donationStatus) ? $x : [];

            if ($x && $request->donationType) $x = ($x->DonationTypeDetail->DonationType->DonationTypeID == $request->donationType) ? $x : [];

            if ($x && ($request->dateStart && $request->dateEnd)) {
                $dateFrom = date('Y-m-d', strtotime($request->dateStart));
                $dateTo = date('Y-m-d', strtotime($request->dateEnd));
                $transactionDate = date('Y-m-d', strtotime($x->TransactionDate));
                if (($transactionDate >= $dateFrom) && ($transactionDate <= $dateTo)) {
                    $x = $x;
                } else {
                    $x = [];
                }
            }

            return $x;
        });
        // dd($data);
        // return view('pdf_recapdonation', compact('data'));
        // $data =
        //     [
        //         'DonaterName' => $request->DonaterName,
        //         'DonationType' => $request->DonationType,
        //         'DonationDate' => $request->DonationDate,
        //         'DonationTItle' => $request->DonationTItle
        //     ];
        $pdf = PDF::loadView('pdf_recapdonation', compact('data'));

        return $pdf->download('Laporan_' . Carbon::now() . '_' . Auth::guard()->user()->FoundationName . '_' . date('Y') . 'Recap' . '.pdf');
    }
}
