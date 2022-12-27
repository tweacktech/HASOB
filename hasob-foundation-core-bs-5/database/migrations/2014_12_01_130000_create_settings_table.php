<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_settings', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');

            $table->integer('display_ordinal')->default(0);
            $table->string('display_type', 200)->nullable();
            $table->string('display_type_options', 200)->nullable();
            $table->string('display_name', 200)->nullable();
            $table->string('allowed_editor_roles', 200)->nullable();
            $table->string('allowed_view_roles', 200)->nullable();
            $table->string('owner_feature', 200)->nullable();

            $table->string('key');
            $table->text('value')->nullable();
            
            $table->string('group_name')->nullable();
            $table->string('model_type')->nullable();
            $table->string('model_value')->nullable();
            
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
        Schema::drop('fc_settings');
    }
}
