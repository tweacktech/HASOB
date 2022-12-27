<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_pageables', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('pageable_type');
            $table->uuid('pageable_id');

            $table->uuid('page_id');
            $table->foreign('page_id')->references('id')->on('fc_pages');

            $table->uuid('creator_user_id')->nullable();
            $table->foreign('creator_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_pageables AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_pageables');
        Schema::enableForeignKeyConstraints();
    }
}
