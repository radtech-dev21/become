<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoanApplicationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('application_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('lead_id');
            $table->double('requested_loan_amount')->nullable();
            $table->string('when_need_money')->comment('immediately,1-2weeks,30 days,more 30days')->nullable();
            $table->string('terms')->comment('short_term,long_term')->nullable();
            $table->string('money_for')->comment('Expand Your Bussiness,Promote Your Bussiness,etc')->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->tinyInteger('step')->default(1);
            $table->string('status')->default('pending')->nullable();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('loan_contact_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('loan_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->unsignedInteger('mobile_number')->nullable();
            $table->string('country_code',10)->nullable();
            $table->unsignedInteger('mobile_number2')->nullable();
            $table->string('country_code2',10)->nullable();
            $table->date('dob')->nullable();
            $table->text('home_address')->nullable();
            $table->double('home_lat')->nullable();
            $table->double('home_long')->nullable();
            $table->text('bussiness_address')->nullable();
            $table->double('bussiness_lat')->nullable();
            $table->double('bussiness_long')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('loan_additional_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('loan_id');
            $table->unsignedInteger('ssn')->nullable();
            $table->unsignedInteger('credit_score')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loan_bussiness_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('loan_id');
            $table->string('legal_name')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('website')->nullable();
            $table->string('registration_date')->nullable();
            $table->unsignedInteger('federal_tax_id')->nullable();
            $table->string('is_owner')->nullable()->comment('yes,no');
            $table->unsignedInteger('owner_percentage')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('who_are_your_customers')->nullable();
            $table->string('number_of_employees')->nullable();
            $table->string('is_store')->nullable();
            $table->string('payment_your_customer')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('loan_applications');
        Schema::dropIfExists('loan_contact_informations');
        Schema::dropIfExists('loan_additional_informations');
        Schema::dropIfExists('loan_bussiness_informations');
    }
}
