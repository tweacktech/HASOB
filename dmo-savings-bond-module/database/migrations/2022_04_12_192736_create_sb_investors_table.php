<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbInvestorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sb_investors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->integer('display_ordinal')->default(0);
            $table->foreignUuid('broker_id')->nullable()->references('id')->on('sb_brokers');
            $table->boolean('is_broker_created')->default(false);
            $table->foreignUuid('user_id')->references('id')->on('fc_users');
            $table->timestamp('date_of_birth')->nullable();
            $table->string('origin_geo_zone');
            $table->string('origin_lga');
            $table->string('address_street');
            $table->string('address_town');
            $table->string('address_state');
            $table->string('status');
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->boolean('is_bank_account_verified')->default(false);
            $table->text('bank_account_meta_data')->nullable();
            $table->string('bank_verification_number');
            $table->boolean('is_bvn_verified')->default(false);
            $table->text('bvn_meta_data')->nullable();
            $table->string('national_id_number');
            $table->boolean('is_nin_verified')->default(false);
            $table->text('nin_meta_data')->nullable();
            $table->string('cscs_id_number');
            $table->boolean('is_cscs_id_verified')->default(false);
            $table->text('cscs_meta_data')->nullable();
            $table->string('chn_id_number');
            $table->boolean('is_chn_id_verified')->default(false);
            $table->text('chn_meta_data')->nullable();
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
        Schema::drop('sb_investors');
    }
}
