<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();
      Schema::create('fc_attachments', function (Blueprint $table) {
        $table->uuid('id')->primary();

          $table->uuid('uploader_user_id')->nullable();
          $table->foreign('uploader_user_id')->references('id')->on('fc_users');

          $table->string('path')->nullable();
          $table->string('path_type')->nullable();

          $table->string('label')->nullable();
          $table->text('description')->nullable();
          $table->string('file_type')->nullable();

          $table->integer('file_number')->default(1);

          $table->string('storage_driver')->nullable();

          $table->text('allowed_viewer_user_ids')->nullable();
          $table->text('allowed_viewer_user_roles')->nullable();
          $table->text('allowed_viewer_user_departments')->nullable();

          $table->uuid('organization_id')->nullable();
          $table->foreign('organization_id')->references('id')->on('fc_organizations');
          
          $table->softDeletes();
          $table->timestamps();

      });
      Schema::enableForeignKeyConstraints();
      //DB::update("ALTER TABLE fc_attachments AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_attachments');
        Schema::enableForeignKeyConstraints();
    }
}
