<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    //
    protected $fillable = [
        "id", "name", "account_id", "account_name", "type", "completed_deals_usd_profit", "active_deals_usd_profit", "total_usd_profit", "pairs",
        "take_profit", "base_order_volume", "safety_order_volume", "max_active_deals", "safety_order_step_percentage", "martingale_volume_coefficient",
        "martingale_step_coefficient", "strategy_list", "take_profit_type", "created_at", "updated_at", "max_safety_orders", "active_safety_orders_count",
        "is_enabled", "active_deals_count", "deletable?", "strategy", "base_order_volume_type", "safety_order_volume_type"
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

    public function setPairsAttribute($value) {
        if (isset($value)) {
            $this->attributes['pairs'] = json_encode($value);
        }
    }

    public function getPairsAttribute($value) {
        if (isset($value))
            return json_decode($value);
        else
            return [];
    }

    public function setStrategyListAttribute($value) {
        if (isset($value)) {
            $this->attributes['strategy_list'] = json_encode($value);
        }
    }

    public function getStrategyListAttribute($value) {
        if (isset($value))
            return json_decode($value);
        else
            return [];
    }

    public function deals() {
        return $this->belongsToMany('App\Deal');
    }

    public function smart_switch_dual()
    {
        return $this->hasMany('App\Bot', 'long_bot_id')
                    ->orWhere('short_bot_id', $this->id);
    }

    public function active_deals() {
        return $this->belongsToMany('App\Deal')->where('finished?', 0);
    }
}
