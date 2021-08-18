<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User,App\Models\LoanApplication;
use App\Models\Status;
class LoanApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'status_id',
        'lead_id',
        'requested_loan_amount',
        'when_need_money',
        'terms',
        'money_for',
        'agent_id',
        'step',
        'status',
        'created_by_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'additional_info','bussiness_info','contact_info','color_code','color_code_opcity'
    ];

    /**
     * Get the Loan Additional Info.
     *
     * @return string
     */
    public function getAdditionalInfoAttribute()
    {
        return \App\Models\LoanAdditionalInformation::where('loan_id',$this->id)->first();
    }
    /**
     * Get the Loan Additional Info.
     *
     * @return string
     */
    public function getColorCodeAttribute()
    {
        return \App\Models\Status::where('id',$this->status_id)->pluck('color_code')->first();
    }

    /* Convert hexdec color string to rgb(a) string */
 
    public function getColorCodeOpcityAttribute() {
    $default = 'rgb(0,0,0)';
    $color = \App\Models\Status::where('id',$this->status_id)->pluck('color_code')->first();
 
    //Return default if no color provided
    if(empty($color))
          return $default; 
 
    //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
        $opacity = 0.25;
        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
    }
    /**
     * Get the Loan Bussiness Info.
     *
     * @return string
     */
    public function getBussinessInfoAttribute()
    {
        return \App\Models\LoanBussinessInformation::where('loan_id',$this->id)->first();
    }
    /**
     * Get the Loan Contact Info.
     *
     * @return string
     */
    public function getContactInfoAttribute()
    {
        return \App\Models\LoanContactInformation::where('loan_id',$this->id)->first();
    }

    public static function gemLoanApplicationId(){

    }

    public static function postApplication($user,$request){
            $input = $request->except('_method','_token','submit');
            $loanapplication = [
                'requested_loan_amount'=>$input['requested_loan_amount'],
                'when_need_money'=>$input['when_need_money'],
                'terms'=>$input['terms'],
                'money_for'=>$input['money_for']
            ];
            if(!isset($input['loan_id']) ||  $input['loan_id']==''){
                $status = Status::where('name','in_progress')->first();
                $loanapplication['status_id'] = $status->id;
                $loanapplication['lead_id'] = $user->id;
                $loanapplication['status'] = $status->name;
                $application = LoanApplication::create($loanapplication);
                $application->application_id = 100000 + $application->id;
                $application->save();
                $input['loan_id'] = $application->id;
                $application = LoanApplication::find($application->id);   
            }else{
                $application = LoanApplication::where('id',$input['loan_id'])->update($loanapplication);   
            }
            $additional_informations = [
                'ssn'=>$input['ssn'],
                'credit_score'=>$input['credit_score']
            ];
            $exist = \App\Models\LoanAdditionalInformation::where('loan_id',$input['loan_id'])->first();
            if($exist){
                \App\Models\LoanAdditionalInformation::where('loan_id',$input['loan_id'])->update($additional_informations);
            }else{
                $additional_informations['loan_id'] = $input['loan_id'];
                \App\Models\LoanAdditionalInformation::create($additional_informations);
            }
            $bussiness_informations = [
                'legal_name'=>isset($input['legal_name'])?$input['legal_name']:null,
                'trade_name'=>isset($input['trade_name'])?$input['trade_name']:null,
                'website'=>isset($input['website'])?$input['website']:null,
                'registration_date'=>isset($input['registration_date'])?$input['registration_date']:null,
                'federal_tax_id'=>isset($input['federal_tax_id'])?$input['federal_tax_id']:null,
                'is_owner'=>isset($input['is_owner'])?$input['is_owner']:null,
                'owner_percentage'=>isset($input['owner_percentage'])?$input['owner_percentage']:null,
                'entity_type'=>isset($input['entity_type'])?$input['entity_type']:null,
                'industry_type'=>isset($input['industry_type'])?$input['industry_type']:null,
                'who_are_your_customers'=>isset($input['who_are_your_customers'])?$input['who_are_your_customers']:null,
                'number_of_employees'=>isset($input['number_of_employees'])?$input['number_of_employees']:null,
                'is_store'=>isset($input['is_store'])?$input['is_store']:null,
                'payment_your_customer'=>isset($input['payment_your_customer'])?$input['payment_your_customer']:null,
                'entity_name'=>isset($input['entity_name'])?$input['entity_name']:null,
            ];
            $exist = \App\Models\LoanBussinessInformation::where('loan_id',$input['loan_id'])->first();
            if($exist){
                \App\Models\LoanBussinessInformation::where('loan_id',$input['loan_id'])->update($bussiness_informations);
            }else{
                $bussiness_informations['loan_id'] = $input['loan_id'];
                \App\Models\LoanBussinessInformation::create($bussiness_informations);
            }
            $contact_info = [
                'first_name'=>$input['first_name'],
                'last_name'=>$input['last_name'],
                'email'=>$input['email'],
                'email2'=>isset($input['email2'])?$input['email2']:null,
                'mobile_number'=>$input['mobile_number'],
                'mobile_number2'=>isset($input['mobile_number2'])?$input['mobile_number2']:null,
                'dob'=>isset($input['dob'])?$input['dob']:null,
                'home_address'=>isset($input['home_address'])?$input['home_address']:null,
                'bussiness_address'=>isset($input['bussiness_address'])?$input['bussiness_address']:null,
            ];
            $exist = \App\Models\LoanContactInformation::where('loan_id',$input['loan_id'])->first();
            if($exist){
                \App\Models\LoanContactInformation::where('loan_id',$input['loan_id'])->update($contact_info);
            }else{
                $contact_info['loan_id'] = $input['loan_id'];
                \App\Models\LoanContactInformation::create($contact_info);
            }
            $user = \App\Models\User::where('id',$user->id)->first();
            if(isset($contact_info['first_name'])){
                $user->name = $contact_info['first_name'].' '.$contact_info['last_name'];
            }
            if(isset($contact_info['mobile_number'])){
                $user->phone = $contact_info['mobile_number'];
            }
            if(isset($contact_info['email'])){
                $user->email = $contact_info['email'];
            }
            if(isset($input['requested_loan_amount'])){
                $user->lenders = $input['requested_loan_amount'];
            }
            if(isset($input['state'])){
                $user->state = $input['state'];
            }
            $user->save();
            return;
        }

}
