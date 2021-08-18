<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanBussinessInformation extends Model
{
    use HasFactory;
    protected $table = 'loan_bussiness_informations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id',
        'legal_name',
        'trade_name',
        'website',
        'registration_date',
        'federal_tax_id',
        'is_owner',
        'owner_percentage',
        'entity_type',
        'industry_type',
        'who_are_your_customers',
        'number_of_employees',
        'is_store',
        'payment_your_customer',
        'entity_name',
    ];
}
