<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcPaymentDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_payment_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->string('label', 200);
            $table->boolean('is_preferred')->default(true);
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->string('bank_verification_number');
            $table->string('national_id_number');
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->uuid('payable_id')->nullable();
            $table->string('payable_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fc_payment_details');
    }
}
