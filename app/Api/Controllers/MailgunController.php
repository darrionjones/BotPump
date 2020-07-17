<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 12.10.18
 * Time: 10:13
 */

namespace App\Api\Controllers;

use App\ApiKey;
use App\Bot;
use App\Deal;
use App\SmartSwitchDual;
use Log;

use App\ThreeCommas\ThreeCommas;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MailgunController extends Controller
{
    use ThreeCommas;

    public function __construct()
    {
        $this->loadThreeCommas();
        Log::useDailyFiles(storage_path() . '/logs/ThreeCommasController.log');
    }

    public function parse(Request $request) {
        $json = $request->input('stripped-text');

        $jsonObj = json_decode($json);
        if ($jsonObj) {
            $smartSwitch = SmartSwitchDual::where('json_long', 'like', "%{$jsonObj->token}%")
                ->orWhere('json_short', 'like', "%{$jsonObj->token}%")->first();

            if ($smartSwitch) {
                if ($smartSwitch->is_enabled == 1) {
                    // TODO: Log to database "Request Received"

                    $apiKeys = $smartSwitch->user->api_keys;
                    if (count($apiKeys) > 0) {
                        $bot = null;
                        $otherBot = null;
                        if (str_contains($smartSwitch->json_long, $jsonObj->token)) { // long bot
                            $bot = $this->getBot($apiKeys[0], $smartSwitch->long_bot_id);
                            $otherBot = $this->getBot($apiKeys[0], $smartSwitch->short_bot_id);

                            $switchAction = $smartSwitch->long_switch_action;
                            $otherSwitchAction = $smartSwitch->short_switch_action;
                            $startAction = $smartSwitch->first_long_deal;
                            $otherStartAction = $smartSwitch->first_short_deal;
                        } else { // short bot
                            $bot = $this->getBot($apiKeys[0], $smartSwitch->short_bot_id);
                            $otherBot = $this->getBot($apiKeys[0], $smartSwitch->long_bot_id);

                            $switchAction = $smartSwitch->short_switch_action;
                            $otherSwitchAction = $smartSwitch->long_switch_action;
                            $startAction = $smartSwitch->first_short_deal;
                            $otherStartAction = $smartSwitch->first_long_deal;
                        }

                        // TODO: should check both bots strategy
                        $strategy = $bot->strategy_list[0]->strategy;
                        $otherStrategy = $otherBot->strategy_list[0]->strategy;

                        $conditions = ["manual", "trading_view", "nonstop"];

                        if (in_array($strategy, $conditions) && in_array($otherStrategy, $conditions)) {    // bot start condition is okay
                            $status = $this->isEnabledBot($bot, $otherBot);

                            if ($status) {     // JSON bot is same as current enabled bot
                                if ($strategy == "manual" && ($switchAction == 'panic' || $switchAction == 'change_tp')) {    // start condition is manual & user setting is ASAP or ASAP & Enable
                                    $activeDeals = $this->hasActiveDeals($bot);
                                    if ($activeDeals > 0) {
                                        // TODO: Do nothing, Log to DB
                                        return response()->json([
                                            'status' => 'ok',
                                            'message' => 'Request ignored. Strategy: manual, Has active deals'
                                        ]);
                                    } else {
                                        $response = $this->start_new_deal($apiKeys[0], $bot->id);
                                        if ($response['status'] == 201) {
                                            // TODO: Log to DB
                                            return response()->json([
                                                'status' => 'ok',
                                                'message' => 'Start new deal ASAP.'
                                            ]);
                                        }
                                    }
                                } else {    // start condition is not manual
                                    // TODO: Ignore and Log to DB
                                    return response()->json([
                                        'status' => 'ok',
                                        'message' => 'Request ignored. Start condition okay, but not manual'
                                    ]);
                                }
                            } else {        // JSON bot is not same as current enabled bot
                                // Bot check on the other bot, not the one in the JSON
                                $enabled = $this->isEnabledBot($otherBot, $bot);
                                $activeDeals = $this->hasActiveDeals($otherBot);

                                if ($enabled && $activeDeals > 0) { // has active deals, enabled
                                    // TODO: proceed to switch

                                    $this->doSwitchAction($apiKeys[0], $bot, $switchAction);

                                    $this->doSwitchReversalAction($apiKeys[0], $otherBot, $otherStartAction);

                                    $this->disable_bot($apiKeys[0], $otherBot->id);

                                    return response()->json([
                                        'status' => 'ok',
                                        'message' => 'Proceed to switch'
                                    ]);
                                } elseif ($enabled && $activeDeals == 0) { // no active deals, enabled
                                    // TODO: disable bot, start the bot

                                    $this->doSwitchAction($apiKeys[0], $bot, $switchAction);

                                    $this->disable_bot($apiKeys[0], $otherBot->id);

                                    return response()->json([
                                        'status' => 'ok',
                                        'message' => ''
                                    ]);
                                } elseif (!$enabled && $activeDeals > 0) { // has active deals, disabled
                                    // TODO: Do nothing, start the bot
                                    $this->doSwitchAction($apiKeys[0], $bot, $switchAction);

                                    return response()->json([
                                        'status' => 'ok',
                                        'message' => 'Do nothing, start the bot'
                                    ]);
                                } elseif (!$enabled && $activeDeals == 0) { // no active deals, disabled
                                    $this->doSwitchAction($apiKeys[0], $bot, $switchAction);

                                    return response()->json([
                                        'status' => 'ok',
                                        'message' => 'Do switch'
                                    ]);
                                }
                            }
                        } else {    // bot start condition is not acceptable
                            $smartSwitch->is_enabled = 0;
                            $smartSwitch->save();

                            return response()->json([
                                'status' => 'ok',
                                'message' => 'Not acceptable conditions. Strategy: '.$strategy
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status' => 'ok',
                            'message' => 'User has no API key'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'ok',
                        'message' => 'Request ignored. Smart Switch Dual is not enabled.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Could not find SmartSwitchDual.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'JSON parse failed.'
            ]);
        }
    }

    private function isEnabledBot($bot, $otherBot) {
        if ($bot->is_enabled - $otherBot->is_enabled > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function hasActiveDeals($bot)
    {
        return $bot->active_deals_count;
    }

    private function doSwitchAction($apiKey, $bot, $action) {
        if ($action == 'enable') {  // Enable
            $this->enable_bot($apiKey, $bot->id);
        } elseif ($action == 'asap') { // ASAP
            $this->start_new_deal($apiKey, $bot->id);
        } elseif ($action == 'asap_enable') { // ASAP & Enable
            $this->start_new_deal($apiKey, $bot->id);
            $this->enable_bot($apiKey, $bot->id);
        }
    }

    private function doSwitchReversalAction($apiKey, $bot, $action) {
        $deal = Deal::where('status', 'Bought')
            ->where('bot_id', $bot->id)
            ->first();
        if ($deal) {
            if ($action == "cancel") {
                $this->deal_cancel($apiKey, $deal->id);
            } elseif ($action == "panic") {
                $this->panic_sell_smart_trade($apiKey, $deal->id);
            } elseif ($action == "change_tp") {
                $this->deal_update_tp($apiKey, $deal->id, 0.2);
            }
        }
    }

    private function getBot($apiKey, $bot_id) {
        $response = $this->show_bot($apiKey, $bot_id);
        if ($response['status'] == 200) {
            try {
                $bot = Bot::findOrFail($bot_id);
            } catch (ModelNotFoundException $e) {
                $bot = new Bot();
            }

            $bot->fill((array)$response['response']);
            $bot->save();

            return $bot;
        } else {

        }
    }
}