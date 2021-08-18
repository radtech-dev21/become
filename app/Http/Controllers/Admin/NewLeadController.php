<?php

namespace App\Http\Controllers\Admin;

use DB;
use Hash,Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Status;
use Auth;
class NewLeadController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $auth = Auth::user();
        $users = User::query();
        $status_list = Status::get();
        $users = $users->role('leads');
        if($auth->hasRole('agents')){
            $users = $users->whereHas('statusApplication', function ($query) use($auth) {
                $query->where('agent_id', $auth->id);
            });
        }
        $data = $users->orderBy('id','DESC')->take(20)->get();
        foreach ($data as $key => $lead) {
            $application_detail = User::getUserApplication($lead->id);
            $lead->application_status = $application_detail ? $application_detail->status : '';
        }
        $agents = User::role('agents')->orderBy('name','ASC')->get();
        return view('admin.leads.new-leads',compact('data','agents','status_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
