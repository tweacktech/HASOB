<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisabledItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_disabled_items', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->uuid('disable_id');
            $table->string('disable_type');

            $table->boolean('is_disabled')->default(false);
            $table->text('disable_reason')->nullable();
            $table->dateTime('disabled_at')->nullable();
            $table->uuid('disabling_user_id')->nullable();
            $table->foreign('disabling_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_disabled_items AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_disabled_items');
        Schema::enableForeignKeyConstraints();
    }
}
