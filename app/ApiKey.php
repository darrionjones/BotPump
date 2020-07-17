<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Encryption\DecryptException;

class ApiKey extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'api_key', 'secret_key'];

    public function setApiKeyAttribute($value) {
        $this->attributes['api_key'] = encrypt($value);
    }

    public function getApiKeyAttribute($value) {
        try {
            return decrypt($value);
        }
        catch (DecryptException $e) {
            return $value;
        }
    }

    public function setSecretKeyAttribute($value) {
        $this->attributes['secret_key'] = encrypt($value);
    }

    public function getSecretKeyAttribute($value) {
        try {
            return decrypt($value);
        }
        catch (DecryptException $e) {
            return $value;
        }
    }

    public function deals() {
        return $this->hasMany('App\Deal');
    }

    public function bots() {
        return $this->hasMany('App\Bot');
    }
}
