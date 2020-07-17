<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'bots';

    /**
     * Run the migrations.
     * @table bots
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->integer('account_id')->nullable()->default(null);
            $table->string('account_name')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->double('completed_deals_usd_profit')->nullable()->default(null);
            $table->double('active_deals_usd_profit')->nullable()->default(null);
            $table->double('total_usd_profit')->nullable()->default(null);
            $table->string('pairs')->nullable()->default(null);
            $table->double('take_profit')->nullable()->default(null);
            $table->double('base_order_volume')->nullable()->default(null);
            $table->double('safety_order_volume')->nullable()->default(null);
            $table->integer('max_active_deals')->nullable()->default(null);
            $table->double('safety_order_step_percentage')->nullable()->default(null);
            $table->double('martingale_volume_coefficient')->nullable()->default(null);
            $table->double('martingale_step_coefficient')->nullable()->default(null);
            $table->string('strategy_list')->nullable()->default(null);
            $table->string('take_profit_type')->nullable()->default(null);
            $table->integer('max_safety_orders')->nullable()->default(null);
            $table->integer('active_safety_orders_count')->nullable()->default(null);
            $table->tinyInteger('is_enabled')->nullable()->default(null);
            $table->integer('active_deals_count')->nullable()->default(null);
            $table->tinyInteger('deletable?')->nullable()->default(null);
            $table->string('strategy')->nullable()->default(null);
            $table->string('base_order_volume_type')->nullable()->default(null);
            $table->string('safety_order_volume_type')->nullable()->default(null);
            $table->integer('api_key_id')->nullable()->default(null);
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
