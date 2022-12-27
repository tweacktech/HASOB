<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_tags', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name');
            $table->index('name');

            $table->text('meta_data')->nullable();
            
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->uuid('parent_id')->nullable();
            //$table->foreign('parent_id')->references('id')->on('fc_tags');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_tags AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_tags');
        Schema::enableForeignKeyConstraints();
    }
}
