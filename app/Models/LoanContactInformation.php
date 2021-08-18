<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanContactInformation extends Model
{
    use HasFactory;
    protected $table = 'loan_contact_informations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id',
        'first_name',
        'last_name',
        'email',
        'email2',
        'mobile_number',
        'country_code',
        'mobile_number2',
        'country_code2',
        'dob',
        'home_address',
        'home_lat',
        'home_long',
        'bussiness_address',
        'bussiness_lat',
        'bussiness_long',
    ];
}
