<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbSubscriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sb_subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->integer('display_ordinal')->default(0);
            $table->foreignUuid('offer_id')->references('id')->on('sb_offers');
            $table->foreignUuid('user_id')->references('id')->on('fc_users');
            $table->foreignUuid('broker_id')->references('id')->on('sb_brokers');
            $table->string('broker_code');
            $table->string('broker_name');
            $table->boolean('is_broker_created')->default(false);
            $table->string('status');
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->integer('units_requested')->default(0);
            $table->decimal('price_per_unit', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->decimal('interest_rate_pct', 15, 2)->nullable();
            $table->timestamp('offer_start_date')->nullable();
            $table->timestamp('offer_end_date')->nullable();
            $table->timestamp('offer_settlement_date')->nullable();
            $table->timestamp('offer_maturity_date')->nullable();
            $table->integer('tenor_years')->nullable();
            $table->string('investor_email');
            $table->string('investor_telephone')->nullable();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->timestamp('date_of_birth')->nullable();
            $table->string('origin_geo_zone');
            $table->string('origin_lga');
            $table->string('address_street');
            $table->string('address_town');
            $table->string('address_state');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->string('bank_verification_number');
            $table->string('national_id_number');
            $table->string('cscs_id_number');
            $table->string('chn_id_number');
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
        Schema::drop('sb_subscriptions');
    }
}
