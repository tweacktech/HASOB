<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_ledgers', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('code')->nullable();

            $table->uuid('ledgerable_id')->nullable();
            $table->string('ledgerable_type')->nullable();

            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('fc_departments');
            
            $table->uuid('creator_user_id')->nullable();
            $table->foreign('creator_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_ledgers AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_ledgers');
        Schema::enableForeignKeyConstraints();
    }
}
