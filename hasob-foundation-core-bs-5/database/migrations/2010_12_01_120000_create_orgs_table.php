<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('fc_organizations', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            $table->string('org');
            $table->string('domain');
            $table->string('full_url');
            $table->string('subdomain');

            $table->boolean('is_local_default_organization')->default(false);
            $table->boolean('is_shut_down')->default(false);
            $table->text('shut_down_reason')->nullable();

            $table->index('org');
            $table->index('domain');
            $table->index('full_url');
            $table->index('subdomain');

            $table->timestamps();
            $table->softDeletes();

        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_organizations AUTO_INCREMENT = 98701;");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('fc_organizations');
        Schema::enableForeignKeyConstraints();
    }
}
