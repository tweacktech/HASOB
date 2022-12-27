<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_site_artifacts', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('headline');
            $table->string('type');
            $table->text('content')->nullable();
            
            $table->integer('display_ordinal')->default(0);

            $table->boolean('is_sticky')->default(false);
            $table->boolean('is_flashing')->default(false);

            $table->boolean('is_external_url')->default(false);
            $table->string('external_url')->nullable();

            $table->dateTime('display_start_date')->nullable();
            $table->dateTime('display_end_date')->nullable();

            $table->dateTime('specific_display_date')->nullable();
            
            $table->uuid('page_id')->nullable();
            $table->foreign('page_id')->references('id')->on('fc_pages');

            $table->uuid('site_id')->nullable();
            $table->foreign('site_id')->references('id')->on('fc_sites');

            $table->uuid('creator_user_id')->nullable();
            $table->foreign('creator_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_site_artifacts AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_site_artifacts');
        Schema::enableForeignKeyConstraints();
    }
}
