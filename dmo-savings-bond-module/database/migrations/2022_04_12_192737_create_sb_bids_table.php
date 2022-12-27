<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbBidsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sb_bids', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->integer('display_ordinal')->default(0);
            $table->foreignUuid('offer_id')->references('id')->on('sb_offers');
            $table->foreignUuid('user_id')->references('id')->on('fc_users');
            $table->string('status');
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->integer('units_requested')->default(0);
            $table->decimal('price_per_unit', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
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
        Schema::drop('sb_bids');
    }
}
