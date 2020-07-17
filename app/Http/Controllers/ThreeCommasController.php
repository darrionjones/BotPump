<?php

namespace App\Http\Controllers;

use App\Bot;
use App\Deal;
use App\ThreeCommas\ThreeCommas;
use Config;
use Auth;
use Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dyaa\Pushover\Facades\Pushover;

class ThreeCommasController extends Controller
{
    //
    use ThreeCommas;

    public function __construct()
    {
        $this->loadThreeCommas();
        Log::useDailyFiles(storage_path() . '/logs/ThreeCommasController.log');
    }

    public function loadDealFrom3Commas() {
        $user = Auth::user();
        if (sizeof($user->api_keys) > 0) {
            $limit = 10000;
            $offset = 0;
            do {
                $response = $this->user_deals($user->api_keys[0], $limit, $offset);
                if ($response['status'] != 200) {
                    Log::critical(['user_id' => $user->id, 'username' => $user->name, 'loadDealFrom3CommasResponse' => $response['status'], 'message' => $response['response']]);
                    Pushover::push('loadDealFrom3CommasResponse', $response['response']);
                    Pushover::send();
                    break;
                } else {
                    $data = $response['response'];
                    foreach ($data as $json) {
                        try {
                            try {
                                $deal = Deal::findOrFail($json->id);
                            } catch (ModelNotFoundException $e) {
                                $deal = new Deal();
                            }
                            $deal->fill((array)$json);
                            $deal->api_key_id = $user->api_keys[0]['id'];
                            $deal->save();
                        } catch (QueryException $exception) {

                        }
                    }
                    $loaded = count($data);
                    $offset += count($data);
                }
            } while ($loaded == $limit);

        }

        echo 'succeed';
    }

    public function loadBotsFrom3Commas() {
        $user = Auth::user();
        if (sizeof($user->api_keys) > 0) {
            $response = $this->user_bots($user->api_keys[0]);
            if ($response['status'] == 200) {
                $data = $response['response'];
                foreach ($data as $json) {
                    try {
                        try {
                            $bot = Bot::findOrFail($json->id);
                        } catch (ModelNotFoundException $e) {
                            $bot = new Bot();
                        }
                        $bot->fill((array)$json);
                        $bot->api_key_id = $user->api_keys[0]['id'];
                        $bot->save();
                    } catch (QueryException $exception) {

                    }
                }
            } else {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'loadBotsFrom3CommasResponse' => $response['status'], 'message' => $response['response']]);
                Pushover::push('loadBotsFrom3CommasResponse', $response['response']);
                Pushover::send();
            }
        }

        echo 'succeed';
    }

    public function panicSellDeal($deal_id) {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {
            $response = $this->deal_panic_sell($user->api_keys[0], $deal_id);
            if ($response['status'] == 200) {
                $data = $response['response'];
                return response()->json($data);
            } else {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'panicSellDealResponse' => $response['status'], 'message' => $response['response']]);
                Pushover::push('panicSellDealResponse', $response['response']);
                Pushover::send();
            }
        }

        echo 'succeed';
    }

    public function cancelDeal($deal_id) {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {
            $response = $this->deal_cancel($user->api_keys[0], $deal_id);
            if ($response['status'] == 200) {
                $data = $response['response'];
                return response()->json($data);
            } else {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'cancelDealResponse' => $response['status'], 'message' => $response['response']]);
                Pushover::push('cancelDealResponse', $response['response']);
                Pushover::send();
            }
        }

        echo 'succeed';
    }

    public function disableBot($bot_id) {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {
            $response = $this->disable_bot($user->api_keys[0], $bot_id);
            if ($response['status'] == 200) {
                $data = $response['response'];
                return response()->json($data);
            } else {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'disableBotResponse' => $response['status'], 'message' => $response['response']]);
                Pushover::push('disableBotResponse', $response['response']);
                Pushover::send();
            }
        }

        echo 'succeed';
    }

    public function enableBot($bot_id) {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {
            $response = $this->enable_bot($user->api_keys[0], $bot_id);
            if ($response['status'] == 200) {
                $data = $response['response'];
                return response()->json($data);
            } else {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'enableBotResponse' => $response['status'], 'message' => $response['response']]);
                Pushover::push('enableBotResponse', $response['response']);
                Pushover::send();
            }
        }

        echo 'succeed';
    }

    public function startNewDeal($bot_id) {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {
            $response = $this->start_new_deal($user->api_keys[0], $bot_id);
            if ($response['status'] == 200) {
                $data = $response['response'];
                return response()->json($data);
            } else {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'startNewDealResponse' => $response['status'], 'message' => $response['response']]);
                Pushover::push('startNewDealResponse', $response['response']);
                Pushover::send();
            }
        }

        echo 'succeed';
    }
}
