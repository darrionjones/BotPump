<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Encryption\DecryptException;

class ExchangeKey extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'api_key', 'secret_key'];

    public function setExchangeKeyAttribute($value) {
        $this->attributes['api_key'] = encrypt($value);
    }

    public function getExchangeKeyAttribute($value) {
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
}
