<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_checklist_items', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('list_name');
            
            $table->text('item_label')->nullable();
            $table->text('item_description');

            $table->boolean('item_passed')->default(false);
            $table->boolean('item_failed')->default(false);
            $table->boolean('item_checked')->default(false);
            $table->text('item_failed_notes')->nullable();

            $table->integer('ordinal')->default(0);

            $table->boolean('requires_attachment')->default(true);
            $table->string('required_attachment_mime_type')->nullable();

            $table->boolean('requires_input')->default(true);
            $table->string('required_input_type')->nullable();
            $table->string('required_input_validation')->nullable();
            
            $table->boolean('is_yes_no')->default(false);
            $table->boolean('item_na')->default(false);

            $table->uuid('owner_type_id');
            $table->string('owner_type');

            $table->uuid('checking_user_id')->nullable();
            $table->foreign('checking_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_checklist_items AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_checklist_items');
        Schema::enableForeignKeyConstraints();
    }
}
