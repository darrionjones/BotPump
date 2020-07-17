<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 09.10.18
 * Time: 04:34
 */

namespace App\Http\Controllers\Traits;

use Auth;
use DB;

trait Dashboard
{
    public function dashboardData() {
        $user = Auth::user();

        //TODO: create table to store these values updated by a cron rather than query the db on each dashboard view. This data might only be used during testing to verify data.
        if (sizeof($user->api_keys) > 0) {
            $data['api_key_id'] = $user->api_keys[0]->id;
            $data['completed_deals'] = DB::table('deals')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('finished?', 1)
                ->count();

            $data['active_deals'] = DB::table('deals')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('finished?', 0)
                ->count();

            $data['active_deals_list'] = DB::table('deals')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('finished?', 0)
                ->get();

            $data['recent_completed_deals'] = DB::table('deals')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('finished?', 1)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();

            $bases = DB::table('deals')
                ->select(DB::raw('SUBSTRING_INDEX(pair, "_", 1) base'))
                ->where('api_key_id', $user->api_keys[0]->id)
                ->whereNotNull('pair')
                ->groupBy('base')
                ->get();

            $data['bot_count'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->count();

            $data['active_bots'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('is_enabled', true)
                ->count();

            $data['active_bots_list'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('is_enabled', true)
                ->get();

            $data['base_profit'] = [];
            $total_completed  = 0;
            $total_panic = 0;
            $total_stop = 0;
            $total_switched = 0;
            $total_failed = 0;
            $total_cancelled = 0;
            $total_actual = 0;

            foreach ($bases as $base) {
                $base_pair = $base->base . "_%";
                $base_profit = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['completed', 'panic_sold', 'stop_loss_finished'])
                    ->sum('final_profit');

                $base_deals = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['completed', 'panic_sold', 'stop_loss_finished'])
                    ->count();

                $base_completed = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['completed'])
                    ->count();

                $base_panic = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['panic_sold'])
                    ->count();

                $base_stop = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['stop_loss_finished'])
                    ->count();

                $base_switched = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['switched'])
                    ->count();

                $base_failed = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['failed'])
                    ->count();

                $base_cancelled = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->whereIn('status', ['cancelled'])
                    ->count();

                $base_actual = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->count();

                $base_unique = DB::table('deals')
                    ->where('api_key_id', $user->api_keys[0]->id)
                    ->where('finished?', 1)
                    ->where('pair', 'LIKE', $base_pair)
                    ->distinct()->get(['pair']);

                $base_unique = count($base_unique);

                $pair_profit = (object) [
                    'base'      => $base->base,
                    'profit'    => '+'.$base_profit,
                    'unique'    => $base_unique,
                    'completed' => $base_completed,
                    'panic'     => $base_panic,
                    'stop'      => $base_stop,
                    'switched'  => $base_switched,
                    'failed'    => $base_failed,
                    'cancelled' => $base_cancelled,
                    'actual'    => $base_actual
                ];

                array_push($data['base_profit'], $pair_profit);
                $total_completed = $total_completed + $base_completed;
                $total_panic = $total_panic + $base_panic;
                $total_stop = $total_stop + $base_stop;
                $total_switched = $total_switched + $base_switched;
                $total_failed = $total_failed + $base_failed;
                $total_cancelled = $total_cancelled + $base_cancelled;
                $total_actual = $total_actual + $base_actual;

            }

            $total_profit = (object) [
                'base'      => '',
                'profit'    => '',
                'unique'    => '',
                'completed' => $total_completed,
                'panic'     => $total_panic,
                'stop'      => $total_stop,
                'switched'  => $total_switched,
                'failed'    => $total_failed,
                'cancelled' => $total_cancelled,
                'actual'    => $total_actual
            ];

            array_push($data['base_profit'], $total_profit);

        } else {
            $data['completed_deals'] = 0;
            $data['active_deals'] = 0;
            $data['bot_count'] = 0;
            $data['active_bots'] = 0;
            $data['active_deals_list'] = [];
            $data['active_bots_list'] = [];
            $data['recent_completed_deals'] = [];
            $data['api_key_id'] = 0;
        }

        return $data;
    }
}