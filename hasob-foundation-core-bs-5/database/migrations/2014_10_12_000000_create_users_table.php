<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('fc_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('user_code')->nullable();
            
            $table->string('preferred_name')->nullable();
            $table->string('physical_location')->nullable();

            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('fc_departments');

            $table->string('job_title')->nullable();

            $table->dateTime('last_loggedin_at')->nullable();

            $table->boolean('is_disabled')->default(false);
            $table->text('disable_reason')->nullable();
            $table->dateTime('disabled_at')->nullable();

            $table->uuid('disabling_user_id')->nullable();
            //$table->foreign('disabling_user_id')->references('id')->on('fc_users');

            $table->binary('profile_image')->nullable();

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');

            $table->boolean('is_ad_import')->default(false);
            $table->string('ad_type')->nullable();
            $table->string('ad_key')->nullable();
            $table->text('ad_data')->nullable();
            
            $table->string('presence_status')->default("available");
            $table->text('leave_delegation_notes')->nullable();

            $table->integer('ranking_ordinal')->default(1);
            $table->boolean('is_first_login')->default(false);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_users AUTO_INCREMENT = 8701;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_users');
        Schema::enableForeignKeyConstraints();
    }
}
