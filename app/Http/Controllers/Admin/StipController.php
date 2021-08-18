<?php

namespace App\Http\Controllers\Admin;
use App\Models\Stip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StipController extends Controller{

    public function postApplication(Request $request, $lead_id){
    	if($request->has('file')) {
            $stip = new Stip();
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('stip', $fileName, 'public');
            $stip->filename = $fileName;
            $stip->lead_id = $lead_id;
            $stip->save();
            return response()->json(['status' => 'success', 'message' => 'Stip has been uploaded.','filename' =>  $fileName]);
        }
    }
}
