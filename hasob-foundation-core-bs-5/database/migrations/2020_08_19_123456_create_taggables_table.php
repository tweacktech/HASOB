<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_taggables', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('fc_users');

            $table->uuid('tag_id')->nullable();
            $table->foreign('tag_id')->references('id')->on('fc_tags');

            $table->uuid('taggable_id');
            $table->string('taggable_type');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_taggables AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_taggables');
        Schema::enableForeignKeyConstraints();
    }
}
