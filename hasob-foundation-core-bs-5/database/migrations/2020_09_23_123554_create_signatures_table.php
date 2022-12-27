<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_signatures', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('staff_name')->nullable();
            $table->string('staff_title')->nullable();
            $table->string('on_behalf')->nullable();

            $table->binary('signature_image')->nullable();

            $table->uuid('owner_user_id')->nullable();
            $table->foreign('owner_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_signatures AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_signatures');
        Schema::enableForeignKeyConstraints();
    }
}
