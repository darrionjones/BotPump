<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'deals';

    /**
     * Run the migrations.
     * @table deals
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id')->nullable()->default(null);
            $table->integer('bot_id')->nullable()->default(null);
            $table->string('bot_name')->nullable()->default(null);
            $table->string('account_name')->nullable()->default(null);
            $table->string('pair')->nullable()->default(null);
            $table->double('take_profit')->nullable()->default(null);
            $table->double('base_order_volume')->nullable()->default(null);
            $table->double('safety_order_volume')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->double('final_profit')->nullable()->default(null);
            $table->double('usd_final_profit')->nullable()->default(null);
            $table->double('final_profit_percentage')->nullable()->default(null);
            $table->double('actual_profit')->nullable()->default(null);
            $table->double('actual_usd_profit')->nullable()->default(null);
            $table->double('actual_profit_percentage')->nullable()->default(null);
            $table->double('safety_order_step_percentage')->nullable()->default(null);
            $table->double('martingale_coefficient')->nullable()->default(null);
            $table->string('take_profit_type')->nullable()->default(null);
            $table->integer('max_safety_orders')->nullable()->default(null);
            $table->integer('active_safety_orders_count')->nullable()->default(null);
            $table->string('closed_at')->nullable()->default(null);
            $table->double('bought_volume')->nullable()->default(null);
            $table->double('bought_amount')->nullable()->default(null);
            $table->string('from_currency')->nullable()->default(null);
            $table->string('to_currency')->nullable()->default(null);
            $table->integer('from_currency_id')->nullable()->default(null);
            $table->integer('to_currency_id')->nullable()->default(null);
            $table->double('sold_volume')->nullable()->default(null);
            $table->double('sold_amount')->nullable()->default(null);
            $table->tinyInteger('cancellable?')->nullable()->default(null);
            $table->tinyInteger('panic_sellable?')->nullable()->default(null);
            $table->double('bought_average_price')->nullable()->default(null);
            $table->double('take_profit_price')->nullable()->default(null);
            $table->double('current_price')->nullable()->default(null);
            $table->tinyInteger('finished?')->nullable()->default(null);
            $table->string('failed_message')->nullable()->default(null);
            $table->integer('completed_safety_orders_count')->nullable()->default(null);
            $table->integer('current_active_safety_orders')->nullable()->default(null);
            $table->double('reserved_base_coin')->nullable()->default(null);
            $table->double('reserved_second_coin')->nullable()->default(null);
            $table->tinyInteger('deal_has_error')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
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
