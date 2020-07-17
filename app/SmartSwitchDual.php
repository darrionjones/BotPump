<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmartSwitchDual extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'long_bot_id', 'short_bot_id', 'long_switch_action', 'short_switch_action', 'first_long_deal', 'first_short_deal'];

    public function long_bot()
    {
    	return $this->belongsTo('App\Bot', 'long_bot_id');
    }

    public function short_bot()
    {
    	return $this->belongsTo('App\Bot', 'short_bot_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }


}
