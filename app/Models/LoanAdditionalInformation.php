<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAdditionalInformation extends Model
{
    use HasFactory;

    protected $table = 'loan_additional_informations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id',
        'ssn',
        'credit_score'
    ];
     
}
