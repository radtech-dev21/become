<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Hash,Exception;
use App\Models\User;
use App\Models\Stip;
use App\Models\Status;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class LeadController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $auth = Auth::user();
        $users = User::query();
        $users = $users->role('leads')->whereHas('statusApplication', function ($query) use($request) {
            if(isset($request->status))
                $query->where('status', $request->status);
        });
        if($auth->hasRole('agents')){
            $users = $users->whereHas('statusApplication', function ($query) use($request,$auth) {
                $query->where('agent_id', $auth->id);
            });
        }
        $data = $users->orderBy('id','DESC')->get();
        $status = Status::orderBy('pref','ASC')->get();
        foreach ($data as $key => $lead) {
            $lead->application = User::getUserApplication($lead->id);
        }
        $agents = User::role('agents')->orderBy('name','ASC')->get();
        return view('admin.leads.index',compact('data','agents','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()

    {
        $roles = Role::pluck('name','name')->all();
        $state_list = $this->usStateList();
        $agents = User::role('agents')->orderBy('name','ASC')->get();
        return view('admin.leads.add',compact('roles','state_list','agents'));

    }

    public function updateThings(Request $request){
      $user = User::find($request->user_id);
      $amount = str_replace('$','', $request->amount);
      $amount = str_replace(',','', $amount);
      $user->lenders = $amount;
      $user->save();
      $application = LoanApplication::where('lead_id',$user->id)->latest()->first();
      $application->requested_loan_amount = $user->lenders;
      $application->save();
      return response()->json(['status'=>'sucess']);
    }
    public function usStateList(){
        return array(
          'AL' => 'Alabama',
          'AK' => 'Alaska',
          'AZ' => 'Arizona',
          'AR' => 'Arkansas',
          'CA' => 'California',
          'CO' => 'Colorado',
          'CT' => 'Connecticut',
          'DE' => 'Delaware',
          'DC' => 'District Of Columbia',
          'FL' => 'Florida',
          'GA' => 'Georgia',
          'HI' => 'Hawaii',
          'ID' => 'Idaho',
          'IL' => 'Illinois',
          'IN' => 'Indiana',
          'IA' => 'Iowa',
          'KS' => 'Kansas',
          'KY' => 'Kentucky',
          'LA' => 'Louisiana',
          'ME' => 'Maine',
          'MD' => 'Maryland',
          'MA' => 'Massachusetts',
          'MI' => 'Michigan',
          'MN' => 'Minnesota',
          'MS' => 'Mississippi',
          'MO' => 'Missouri',
          'MT' => 'Montana',
          'NE' => 'Nebraska',
          'NV' => 'Nevada',
          'NH' => 'New Hampshire',
          'NJ' => 'New Jersey',
          'NM' => 'New Mexico',
          'NY' => 'New York',
          'NC' => 'North Carolina',
          'ND' => 'North Dakota',
          'OH' => 'Ohio',
          'OK' => 'Oklahoma',
          'OR' => 'Oregon',
          'PA' => 'Pennsylvania',
          'RI' => 'Rhode Island',
          'SC' => 'South Carolina',
          'SD' => 'South Dakota',
          'TN' => 'Tennessee',
          'TX' => 'Texas',
          'UT' => 'Utah',
          'VT' => 'Vermont',
          'VA' => 'Virginia',
          'WA' => 'Washington',
          'WV' => 'West Virginia',
          'WI' => 'Wisconsin',
          'WY' => 'Wyoming',
        );  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'roles' => 'required',
            'lenders' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make('password');
        $user_data = Arr::except($input,array('agent_id'));  
        $user = User::create($user_data);
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        $status = Status::where('name','in_progress')->first();
        $data = [
            'status_id'=>$status->id,
            'lead_id'=>$user->id,
            'status'=>$status->name
        ];
        if($input['agent_id']){
            $data['agent_id'] = $input['agent_id'];
        }
        $application = LoanApplication::firstOrcreate($data);
        $application->application_id = 100000 + $application->id;
        $application->save();
        $busi = \App\Models\LoanContactInformation::firstOrcreate(['loan_id'=>$application->id]);
        $busi->email = $input['email'];
        if(isset($input['phone'])){
            $busi->mobile_number = $input['phone'];
        }

        if(isset($input['lenders'])){
            $application->requested_loan_amount = $input['lenders'];
            $application->save();
        }
        if(isset($input['name'])){
            $name = explode(' ', $input['name']);
            if(isset($name[0])){
                $busi->first_name = $name[0];
            }
            if(isset($name[1])){
                $name2 = (isset($name[2])?$name[2]:' ');
                $busi->last_name = $name[1].' '.$name2;
            }
        }
        $busi->save();
        $roles =  Role::firstOrcreate(['name' => 'leads']);
        $user->assignRole($request->input('roles'));
        return redirect('admin/leads')->with('success','User created successfully');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        $user = User::find($id);
        $state_list = $this->usStateList();
        $stips = Stip::where('lead_id',$id)->get();
        $application = User::getUserApplication($id);
        return view('admin.leads.view',compact('user','application','state_list', 'stips'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function postApplication($id,Request $request)
    {
        $user = User::find($id);
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        LoanApplication::postApplication($user,$request);
        return redirect()->back()->with('success', 'application updateed successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function assignAgent(Request $request)
    {
        try{
            $lead = User::find($request->lead_id);
            $application = LoanApplication::where('lead_id',$lead->id)->latest()->first();
            if($request->type=='add' && !$application){
                $status = Status::where('name','in_progress')->first();
                $data = [
                    'status_id'=>$status->id,
                    'lead_id'=>$lead->id,
                    'status'=>$status->name,
                    'agent_id'=>$request->agent_id
                ];
                $application = LoanApplication::firstOrcreate($data);
                $application->application_id = 100000 + $application->id;
                $application->save();
            }else{
                $application = LoanApplication::where('lead_id',$lead->id)->latest()->first();
                $application->agent_id = $request->agent_id;
                $application->save();
            }
            return response()->json(['status'=>'sucess']);
        }catch(Exception $ex){
            return response()->json(['status'=>'error','message'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateApplicationStatus(Request $request)
    {
        try{
            $lead = User::find($request->lead_id);
            $application = LoanApplication::where('id',$request->id)->first();
            $status = Status::where('id',$request->status_id)->first();
            if(!$application){
                $data = [
                    'status_id'=>$status->id,
                    'lead_id'=>$lead->id,
                    'status'=>$status->name
                ];
                $application = LoanApplication::firstOrcreate($data);
                $application->application_id = 100000 + $application->id;
                $application->save();
            }else{
                $application->status_id = $status->id;
                $application->status = $status->name;
                $application->save();
            }
            return response()->json(['status'=>'sucess']);
        }catch(Exception $ex){
            return response()->json(['status'=>'error','message'=>$ex->getMessage()]);
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $state_list = $this->usStateList();
        $user->application = User::getUserApplication($user->id);
        $agents = User::role('agents')->orderBy('name','ASC')->get();
        return view('admin.leads.edit',compact('user','roles','userRole','state_list','agents'));

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

        $this->validate($request, [
            'name' => 'required',
            'state' => 'required',
            'roles' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        $input = $request->all();
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));    
        // }
        $user_data = Arr::except($input,array('agent_id'));  
        $user = User::find($id);
        $user->update($user_data);
        if(isset($input['agent_id'])){
            $application = LoanApplication::where('lead_id',$user->id)->latest()->first();
            if(!$application){
                $status = Status::where('name','in_progress')->first();
                $data = [
                    'status_id'=>$status->id,
                    'lead_id'=>$user->id,
                    'status'=>$status->name,
                    'agent_id'=>$input['agent_id']
                ];
                $application = LoanApplication::firstOrcreate($data);
                $application->application_id = 100000 + $application->id;
                $application->save();
            }else{
                $application->agent_id = $input['agent_id'];
                $application->save();
            }
          }
          $application = LoanApplication::where('lead_id',$user->id)->latest()->first();
            $busi = \App\Models\LoanContactInformation::firstOrcreate(['loan_id'=>$application->id]);
            $busi->email = $input['email'];
            if(isset($input['phone'])){
                $busi->mobile_number = $input['phone'];
            }
            if(isset($input['lenders'])){
                $application->requested_loan_amount = $input['lenders'];
                $application->save();
            }
            if(isset($input['name'])){
                $name = explode(' ', $input['name']);
                if(isset($name[0])){
                    $busi->first_name = $name[0];
                }
                if(isset($name[1])){
                    $name2 = (isset($name[2])?$name[2]:' ');
                    $busi->last_name = $name[1].' '.$name2;
                }
            }
            $busi->save();
        return redirect('admin/leads')->with('success','User updated successfully');

    }

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        User::find($id)->delete();
        return response()->json(['status'=>'sucess']);
        // return redirect()->route('admin.leads')->with('success','User deleted successfully');

    }
}
