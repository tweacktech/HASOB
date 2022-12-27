<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_pages', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('page_name');
            $table->string('page_path')->nullable();
            $table->text('content')->nullable();

            $table->integer('display_ordinal')->default(0);

            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_published')->default(false);
            $table->boolean('allow_comments')->default(false);

            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('fc_departments');

            $table->boolean('is_blade_rendered')->default(false);
            $table->string('blade_file_path')->nullable();

            $table->boolean('is_external_page')->default(false);
            $table->string('external_page_key')->nullable();
            $table->string('external_page_url')->nullable();

            $table->boolean('is_view_restricted')->default(false);
            $table->string('view_allowed_roles')->nullable();
            $table->string('view_allowed_user_ids')->nullable();

            $table->boolean('is_site_default_page')->default(false);

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
        //DB::update("ALTER TABLE fc_pages AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_pages');
        Schema::enableForeignKeyConstraints();
    }
}
