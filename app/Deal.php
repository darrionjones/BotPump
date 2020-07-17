<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    protected $fillable = [
        "id", "account_id", "bot_id", "bot_name", "account_name", "pair", "take_profit", "base_order_volume", "safety_order_volume",
        "status", "final_profit", "usd_final_profit", "final_profit_percentage", "actual_profit", "actual_usd_profit", "actual_profit_percentage",
        "safety_order_step_percentage", "martingale_coefficient", "take_profit_type", "created_at", "updated_at", "max_safety_orders", "active_safety_orders_count",
        "closed_at", "bought_volume", "bought_amount", "from_currency", "to_currency", "from_currency_id", "to_currency_id", "sold_volume", "sold_amount",
        "cancellable?", "panic_sellable?", "bought_average_price", "take_profit_price", "current_price", "finished?", "failed_message", "completed_safety_orders_count",
        "completed_safety_orders_count", "current_active_safety_orders", "reserved_base_coin", "reserved_second_coin", "deal_has_error", "type", "base_order_volume_type",
        "safety_order_volume_type"
    ];

    public function setCreatedAtAttribute($value) {
        if (isset($value)) {
            $time = strtotime($value);
            $this->attributes['created_at'] = date('Y-m-d H:i:s', $time);
        }
    }

    public function setUpdatedAtAttribute($value) {
        if (isset($value)) {
            $time = strtotime($value);
            $this->attributes['updated_at'] = date('Y-m-d H:i:s', $time);
        }
    }

    public function setClosedAtAttribute($value) {
        if (isset($value)) {
            $time = strtotime($value);
            $this->attributes['closed_at'] = date('Y-m-d H:i:s', $time);
        }
    }

    public function bot() {
        return $this->hasOne('App\Bot');
    }
}
