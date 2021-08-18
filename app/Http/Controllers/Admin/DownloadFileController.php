<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Stip;
use App\Models\FileManager;
use Illuminate\Http\Request;
use App\Models\BankStatement;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class DownloadFileController extends Controller { 

    public function downloadFile($file_id){
    	$file_manger = FileManager::find($file_id);
        $path = storage_path('app/public/document/'.$file_manger->filename);
        return response()->download($path);
    }
    public function downloadBankStatementFile($file_id){
    	$bank_statement = BankStatement::find($file_id);
        $path = storage_path('app/public/bank_statement/'.$bank_statement->filename);
        return response()->download($path);
    }
    public function downloadStip($file_id){
    	$stip = Stip::find($file_id);
        $path = storage_path('app/public/stip/'.$stip->filename);
        return response()->download($path);
    }
}
