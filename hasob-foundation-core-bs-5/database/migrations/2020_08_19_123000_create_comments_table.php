<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_comments', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable();
            //$table->foreign('parent_id')->references('id')->on('fc_comments');

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('fc_users');

            $table->text('content');

            $table->string('status')->nullable();
            $table->string('type')->nullable();

            $table->uuid('commentable_id');
            $table->string('commentable_type');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_comments AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_comments');
        Schema::enableForeignKeyConstraints();
    }
}
