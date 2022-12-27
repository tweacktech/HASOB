<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('fc_departments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('key');
            $table->string('long_name');
            $table->boolean('is_unit')->default(false);

            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('physical_location')->nullable();

            $table->binary('logo_image')->nullable();
            
            $table->boolean('is_ad_import')->default(false);
            $table->string('ad_type')->nullable();
            $table->string('ad_key')->nullable();
            $table->text('ad_data')->nullable();

            $table->uuid('parent_id')->nullable();
            // $table->foreign('parent_id')->references('id')->on('fc_departments');
            //$table->foreignUuid('parent_id')->nullable()->references('id')->on('fc_departments');

            // $table->uuid('organization_id')->nullable();
            // $table->foreign('organization_id')->references('id')->on('fc_organizations');
            $table->foreignUuid('organization_id')->nullable()->references('id')->on('fc_organizations');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_departments AUTO_INCREMENT = 225524;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_departments');
        Schema::enableForeignKeyConstraints();
    }
}
