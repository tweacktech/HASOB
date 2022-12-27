<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcAddressesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->boolean('is_preferred')->default(true);
            $table->string('label', 200);
            $table->string('contact_person')->nullable();
            $table->string('street')->nullable();
            $table->string('town')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone')->nullable();
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->uuid('addressable_id')->nullable();
            $table->string('addressable_type')->nullable();
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
        Schema::drop('fc_addresses');
    }
}
