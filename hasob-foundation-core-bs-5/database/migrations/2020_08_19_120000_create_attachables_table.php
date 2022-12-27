<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_attachables', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('attachment_id');
            $table->foreign('attachment_id')->references('id')->on('fc_attachments');

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('fc_users');

            $table->uuid('attachable_id');
            $table->string('attachable_type');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_attachables AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_attachables');
        Schema::enableForeignKeyConstraints();
    }
}
