<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcBatchesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_batches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->string('name', 200);
            $table->string('status')->nullable();
            $table->string('wf_status')->nullable();
            $table->text('wf_meta_data')->nullable();
            $table->string('batchable_type')->nullable();
            $table->foreignUuid('creator_user_id')->nullable()->references('id')->on('fc_users');
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
        Schema::drop('fc_batches');
    }
}
