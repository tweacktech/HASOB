<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcRatingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_ratings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('fc_organizations');
            $table->string('status')->nullable();
            $table->uuid('ratable_id')->nullable();
            $table->string('ratable_type')->nullable();
            $table->string('description')->nullable();
            $table->integer('score')->default(0);
            $table->integer('max_score')->default(0);
            $table->foreignUuid('creator_user_id')->nullable()->references('id')->on('fc_users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fc_ratings');
    }
}
