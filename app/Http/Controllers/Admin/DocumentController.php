<?php

namespace App\Http\Controllers\Admin;
use App\Models\FileManager;
use Illuminate\Http\Request;
use App\Models\BankStatement;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $file_managers =FileManager::get();
        return view('admin.file-manager', compact('file_managers'));
    }
    
    public function store(Request $request) {
        if($request->has('file')) {
            $file_manger = new FileManager();
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('document', $fileName, 'public');
            $file_manger->user_id = Auth::id();
            $file_manger->filename = $fileName;
            $file_manger->save();
            return response()->json(['status' => 'success', 'message' => 'Document has been uploaded.','filename' =>  $fileName]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postUploadDocument(Request $request, $user_id) {
        if($request->has('file')) {
            $file_manger = new FileManager();
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('document', $fileName, 'public');
            $file_manger->user_id = $user_id;
            $file_manger->filename = $fileName;
            $file_manger->save();
            return response()->json(['status' => 'success', 'message' => 'Document has been uploaded.','filename' =>  $fileName]);
        }
    }

    public function postUploadBankDocument(Request $request, $application_id){
        if($request->has('file')) {
            $file_manger = new BankStatement();
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $file_manger->application_id = $application_id;
            $file_manger->filename = $fileName;
            $file_manger->save();
            $filePath = $request->file('file')->storeAs('bank_statement', $fileName, 'public');
            return response()->json(['status' => 'success', 'message' => 'Bank Statement has been uploaded.','filename' =>  $fileName]);
        }
    }

    public function destroy($id){
        $file_manger = FileManager::find($id);
        if(file_exists(storage_path('app/public/document/'.$file_manger->filename)))unlink(storage_path('app/public/document/'.$file_manger->filename));
        $file_manger->delete();
        return response()->json(['status' => 'success','message' => 'File deleted successfully.']);
    }

}
