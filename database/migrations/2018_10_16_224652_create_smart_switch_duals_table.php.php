<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmartSwitchDualsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'smart_switch_duals';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->integer('long_bot_id');
            $table->integer('short_bot_id');
            $table->string('long_switch_action');
            $table->string('short_switch_action');
            $table->string('first_long_deal');
            $table->string('first_short_deal');
            $table->json('json_long');
            $table->json('json_short');
            $table->integer('is_enabled')->default(0);
            $table->integer('is_active')->default(0);
            $table->string('active_deal_strategy')->default(null);
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->set_schema_table);
    }
}
