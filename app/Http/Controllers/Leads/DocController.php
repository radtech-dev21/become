<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankStatement;
use App\Models\User;
use Auth;
class DocController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$application = User::getUserApplication(Auth::user()->id);
    	if(!$application){
        	return redirect('leads/application')->with('error', 'Please complete your application first');
    	}
        for ($i =1; $i < 7; $i++) {
            $date = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
            $bank_statement =BankStatement::whereDate('statement_date', $date)->first();
            $months[] = array(
                'date' => $date,
                'filename' => $bank_statement ? $bank_statement->filename : '',
                'label' => date("F Y", strtotime( date( 'Y-m-01' )." -$i months")),
            );
        }
        return view('leads.documents', compact('months'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if($request->has('bank_statement')) {
        	$application = User::getUserApplication(Auth::user()->id);
	    	if(!$application){
	        	return redirect('leads/application')->with('error', 'Please complete your application first');
	    	}
            $bank_statement = BankStatement::firstOrNew([
            	'statement_date' => $request->statement_date
            ]);
            $fileName = time().'_'.$request->bank_statement->getClientOriginalName();
            $filePath = $request->file('bank_statement')->storeAs('uploads', $fileName, 'public');
            $bank_statement->application_id = $application->id;
            $bank_statement->filename = $fileName;
            $bank_statement->statement_date = $request->statement_date;
            $bank_statement->save();
            return response()->json(['status' => 'success', 'message' => 'Bank Statement has been uploaded.','filename' =>  $fileName]);
        }
    }
}
