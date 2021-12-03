<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;

class DocumentController extends Controller
{
    public function GetListDocumentApproval(){
        return view ('/Admin/Document/DocumentApproval');
    }

    public function GetListDocumentByFilter(Request $request){
        $Document = Document::all();

        if($request->documentType != 0 ){
            
            $Document = $Document->where('DocumentTypeID',$request->documentType);
        }

        if($request->approvalStatus != 0){
           
            $Document = $Document->where('ApprovalStatusID',$request->approvalStatus);
        }
        

        $ListDocument[] = array();
        foreach($Document as $val){
            $ListDocument[] = ['DocumentID' => $val->DocumentID, 'DocumentType' => $val->DocumentType->DocumentTypeName ,'UploadDate'=>$val->UploadDate, 'FoundationName' => $val->Foundation->FoundationName, 'ApprovalStatusID' => $val->ApprovalStatus->ApprovalStatusID, 'ApprovalStatus' => $val->ApprovalStatus->ApprovalStatusName];
        }
        // unset($ListDocument[0]); 
        
        return response()->json(array('payload' => $ListDocument));
    }

    public function GetDocumentApprovalDetail(Request $request){
        $documentId = $request->documentId;
        $document = Document::where('DocumentID',$documentId)->first();

        $payload = ['DocumentID' => $document->DocumentID, 'DocumentType' => $document->DocumentType->DocumentTypeName ,'UploadDate'=>$document->UploadDate, 'FoundationName' => $document->Foundation->FoundationName, 'ApprovalStatusID' => $document->ApprovalStatus->ApprovalStatusID, 'ApprovalStatus' => $document->ApprovalStatus->ApprovalStatusName,'FilePath' => 'DocumentYayasan/'.$document->path];
        $response = ['payload' => $payload];
        return response()->json($response);
    }

    public function SaveDocumentApproval(Request $request){
        $document = Document::where('DocumentID',$request->documentId)->first();

        $document->ApprovalStatusID = $request->approvalStatusId;
        $document->description = $request->description;
        $document->ReviewDate = Carbon::now();
        $document->save();

        $response = [];
        return response()->json($response);
    }
}
