<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbOffersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sb_offers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->integer('display_ordinal')->default(0);
            $table->string('status');
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->string('offer_title');
            $table->decimal('price_per_unit', 15, 2)->nullable();
            $table->integer('max_units_per_investor')->default(1);
            $table->decimal('interest_rate_pct', 15, 2)->nullable();
            $table->timestamp('offer_start_date')->nullable();
            $table->timestamp('offer_end_date')->nullable();
            $table->timestamp('offer_settlement_date')->nullable();
            $table->timestamp('offer_maturity_date')->nullable();
            $table->integer('tenor_years')->nullable();
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
        Schema::drop('sb_offers');
    }
}
