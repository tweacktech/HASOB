<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('fc_ledger_items', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name');
            $table->text('description')->nullable();

            $table->double('entry_amount',15,2);
            $table->string('entry_type');

            $table->uuid('referenced_item_id')->nullable();
            $table->string('referenced_item_controller_class')->nullable();
            $table->string('referenced_item_controller_method')->nullable();
            $table->string('referenced_item_route_name')->nullable();

            $table->uuid('ledger_id')->nullable();
            $table->foreign('ledger_id')->references('id')->on('fc_ledgers');

            $table->uuid('entry_user_id')->nullable();
            $table->foreign('entry_user_id')->references('id')->on('fc_users');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('fc_organizations');
            
            $table->softDeletes();
            $table->timestamps();
            
        });
        Schema::enableForeignKeyConstraints();
        //DB::update("ALTER TABLE fc_ledger_items AUTO_INCREMENT = 8324;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fc_ledger_items');
        Schema::enableForeignKeyConstraints();
    }
}
