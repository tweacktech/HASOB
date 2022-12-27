<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_sites', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('site_name');
            $table->string('site_path')->nullable();
            $table->text('description')->nullable();

            $table->integer('display_ordinal')->default(0);

            $table->uuid('siteable_id')->nullable();
            $table->string('siteable_type')->nullable();
            
            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('fc_departments');

            $table->boolean('is_blade_rendered')->default(false);
            $table->string('blade_file_path')->nullable();
            
            $table->boolean('is_view_restricted')->default(false);
            $table->string('view_allowed_roles')->nullable();
            $table->string('view_allowed_user_ids')->nullable();

            $table->uuid('creator_user_id')->nullable();
            $table->foreign('creator_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_sites AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_sites');
        Schema::enableForeignKeyConstraints();
    }
}
