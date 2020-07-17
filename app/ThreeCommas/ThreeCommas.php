<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 15.10.18
 * Time: 04:56
 */

namespace App\ThreeCommas;

use Config;
use GuzzleHttp;
use \GuzzleHttp\Exception\GuzzleException;

trait ThreeCommas
{
    protected $threeCommas = [];
    protected $root;

    public function loadThreeCommas() {
        $this->threeCommas = Config::get('3commas');
        $this->root = $this->threeCommas['root'];
    }

    private function requestThreeCommas($key, $api, $parameters = array(), $paths = array()) {
        $config = $this->threeCommas[$api];

        $api_key = $key['api_key'];
        $secret_key = $key['secret_key'];

        $url = $config['end_point'];
        foreach ($paths as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url);
        }

        if ($config['method'] == 'GET') {
            $query = http_build_query($parameters, '', '&');
            $signature = hash_hmac('sha256', $url . '?' . $query, $secret_key);
        } else {
            $signature = hash_hmac('sha256', $url, $secret_key);
        }

        $client = new GuzzleHttp\Client();

        $options = [];
        $options['headers']['APIKEY'] = $api_key;
        if ($config['security'] == 'SIGNED')
            $options['headers']['Signature'] = $signature;

        $options['form_params'] = [];
        foreach ($parameters as $key => $value) {
            if (isset($value)) {
                $options['form_params'][$key] = $value;
            }
        }

        try {
            $response = $client->request($config['method'], $this->root.$url, $options);

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                return [
                    'status' => $response->getStatusCode(),
                    'response' => json_decode($response->getBody())
                ];
            } else {
                return [
                    'status' => $response->getStatusCode(),
                    'response' => $this->threeCommas['response'][$response->getStatusCode()]
                ];
            }
        } catch (GuzzleException $e) {
            return [
                'status' => $e->getCode(),
                'response' => $this->threeCommas['response'][$e->getCode()]
            ];
        }
    }

    public function user_deals($key, $limit = null, $offset = null, $account_id = null, $bot_id = null, $scope = null) {
        return $this->requestThreeCommas($key, 'user_deals', ['limit' => $limit, 'offset' => $offset, 'account_id' => $account_id, 'bot_id' => $bot_id, 'scope' => $scope]);
    }

    public function user_bots($key) {
        return $this->requestThreeCommas($key, 'user_bots');
    }

    public function deal_panic_sell($key, $deal_id) {
        return $this->requestThreeCommas($key, 'deal_panic_sell', ['deal_id' => $deal_id], ['deal_id' => $deal_id]);
    }

    public function deal_cancel($key, $deal_id) {
        return $this->requestThreeCommas($key, 'deal_cancel', ['deal_id' => $deal_id], ['deal_id' => $deal_id]);
    }

    public function disable_bot($key, $bot_id) {
        return $this->requestThreeCommas($key, 'disable_bot', ['bot_id' => $bot_id], ['bot_id' => $bot_id]);
    }

    public function enable_bot($key, $bot_id) {
        return $this->requestThreeCommas($key, 'enable_bot', ['bot_id' => $bot_id], ['bot_id' => $bot_id]);
    }

    public function start_new_deal($key, $bot_id, $pair = null, $skip_signal_checks = null, $skip_open_deals_checks = null) {
        return $this->requestThreeCommas($key, 'start_new_deal', ['bot_id' => $bot_id, 'pair' => $pair, 'skip_signal_checks' => $skip_signal_checks, 'skip_open_deals_checks' => $skip_open_deals_checks], ['bot_id' => $bot_id]);
    }

    public function show_bot($key, $bot_id) {
        return $this->requestThreeCommas($key, 'show_bot', ['bot_id' => $bot_id], ['bot_id' => $bot_id]);
    }

    public function show_deal($key, $deal_id) {
        return $this->requestThreeCommas($key, 'show_deal', ['deal_id' => $deal_id], ['deal_id' => $deal_id]);
    }

    public function bot_stats($key, $account_id = null, $bot_id = null) {
        return $this->requestThreeCommas($key, 'bot_stats', ['account_id' => $account_id, 'bot_id' => $bot_id]);
    }

    public function update_bot($key, $bot_id, $name, $pairs, $base_order_volume, $take_profit, $safety_order_volume, $martingale_volume_coefficient, $martingale_step_coefficient, $max_safety_orders, $active_safety_orders_count, $safety_order_step_percentage, $take_profit_type, $strategy_list,
                               $max_active_deals = null, $base_order_volume_type = null, $safety_order_volume_type = null, $stop_loss_percentage = null, $cooldown = null, $btc_price_limit = null) {
        return $this->requestThreeCommas($key, 'update_bot', [
            'bot_id' => $bot_id,
            'name' => $name,
            'pairs' => $pairs,
            'base_order_volume' => $base_order_volume,
            'take_profit' => $take_profit,
            'safety_order_volume' => $safety_order_volume,
            'martingale_volume_coefficient' => $martingale_volume_coefficient,
            'martingale_step_coefficient' => $martingale_step_coefficient,
            'max_safety_orders' => $max_safety_orders,
            'active_safety_orders_count' => $active_safety_orders_count,
            'safety_order_step_percentage' => $safety_order_step_percentage,
            'take_profit_type' => $take_profit_type,
            'strategy_list' => $strategy_list,
            'max_active_deals' => $max_active_deals,
            'base_order_volume_type' => $base_order_volume_type,
            'safety_order_volume_type' => $safety_order_volume_type,
            'stop_loss_percentage' => $stop_loss_percentage,
            'cooldown' => $cooldown,
            'btc_price_limit' => $btc_price_limit,
        ], ['bot_id' => $bot_id]);
    }

    public function panic_sell_smart_trade($key, $deal_id) {
        return $this->requestThreeCommas($key, 'panic_sell_smart_trade', ['deal_id' => $deal_id], ['deal_id' => $deal_id]);
    }

    public function deal_update_tp($key, $deal_id, $new_take_profit_percentage) {
        return $this->requestThreeCommas($key, 'deal_update_tp', ['deal_id' => $deal_id, 'new_take_profit_percentage' => $new_take_profit_percentage], ['deal_id' => $deal_id]);
    }
}