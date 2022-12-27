<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('fc_model_artifacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string('model_name');
            $table->uuid('model_primary_id');

            $table->string('key');
            $table->text('value')->nullable();
            $table->binary('binary_value')->nullable();

            $table->uuid('invocation_id')->nullable();
            $table->string('invocation_controller_class')->nullable();
            $table->string('invocation_controller_method')->nullable();
            $table->string('invocation_route_name')->nullable();

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_model_artifacts AUTO_INCREMENT = 5524;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_model_artifacts');
        Schema::enableForeignKeyConstraints();
    }
}
