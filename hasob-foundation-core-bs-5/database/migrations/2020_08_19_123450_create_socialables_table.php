<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_socialables', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('type');
            $table->string('handle');

            $table->text('html_meta_snippet')->nullable();

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('fc_users');

            $table->uuid('socialable_id');
            $table->string('socialable_type');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_socialables AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_socialables');
        Schema::enableForeignKeyConstraints();
    }
}
