<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcRelationshipsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_relationships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->string('status')->nullable();
            $table->uuid('primary_item_id')->nullable();
            $table->string('primary_item_type')->nullable();
            $table->uuid('related_item_id')->nullable();
            $table->string('related_item_type')->nullable();
            $table->string('relation_type')->nullable();
            $table->integer('weight')->default(0);
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
        Schema::drop('fc_relationships');
    }
}
