<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFCPaymentAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_payment_attempts', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');

            $table->double('amount',14,2);
            $table->string('attempt_code')->nullable();

            $table->string('payable_type');
            $table->uuid('payable_id');

            $table->string('gateway_url')->nullable();
            $table->string('gateway_name')->nullable();
            $table->string('gateway_reference_code')->nullable();

            $table->string('status')->nullable();
            $table->text('gateway_initialization_response')->nullable();
            $table->string('payment_instrument_type')->nullable();
  
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_verification_passed')->default(false);
            $table->boolean('is_verification_failed')->default(false);
            $table->dateTime('transaction_date')->nullable();

            $table->double('verified_amount',14,2)->default(0.0);
            $table->text('verification_meta')->nullable();
            $table->text('verification_notes')->nullable();
            
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            
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
        Schema::dropIfExists('fc_payment_attempts');
    }
}
