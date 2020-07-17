<?php

return [
    'root' => 'https://3commas.io',
    'user_deals' => [
        'end_point'     => '/public/api/ver1/deals',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'deal_update_max_safety_orders' => [
        'end_point'     => '/public/api/ver1/deals/{deal_id}/update_max_safety_orders',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'deal_panic_sell' => [
        'end_point'     => '/public/api/ver1/deals/{deal_id}/panic_sell',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'deal_cancel' => [
        'end_point'     => '/public/api/ver1/deals/{deal_id}/cancel',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'deal_update_tp' => [
        'end_point'     => '/public/api/ver1/deals/{deal_id}/update_tp',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'show_deal' => [
        'end_point'     => '/public/api/ver1/deals/{deal_id}/show',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'pairs_black_list' => [
        'end_point'     => '/public/api/ver1/bots/pairs_black_list',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'update_pairs_black_list' => [
        'end_point'     => '/public/api/ver1/bots/update_pairs_black_list',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'create_bot' => [
        'end_point'     => '/public/api/ver1/bots/create_bot',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'bot_stats'     => [
        'end_point'     => '/public/api/ver1/bots/stats',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'user_bots' => [
        'end_point'     => '/public/api/ver1/bots',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'update_bot' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/update',
        'method'        => 'PATCH',
        'security'      => 'SIGNED'
    ],
    'disable_bot' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/disable',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'enable_bot' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/enable',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'start_new_deal' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/start_new_deal',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'delete_bot' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/delete',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'panic_sell_all_bot_deals' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/panic_sell_all_deals',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'cancel_all_bot_deals' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/cancel_all_deals',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'show_bot' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/show',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'new_account' => [
        'end_point'     => '/public/api/ver1/bots/{bot_id}/panic_sell_all_deals',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'all_accounts' => [
        'end_point'     => '/public/api/ver1/accounts',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'market_list' => [
        'end_point'     => '/public/api/ver1/accounts/market_list',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'load_account_balances' => [
        'end_point'     => '/public/api/ver1/accounts/{account_id}/load_balances',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'rename_account' => [
        'end_point'     => '/public/api/ver1/accounts/{account_id}/rename',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'pie_chart' => [
        'end_point'     => '/public/api/ver1/accounts/{account_id}/pie_chart_data',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'account_table_data' => [
        'end_point'     => '/public/api/ver1/accounts/{account_id}/account_table_data',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'remove_account' => [
        'end_point'     => '/public/api/ver1/accounts/{account_id}/remove',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'cancel_smart_trade' => [
        'end_point'     => '/public/api/ver1/smart_trades/cancel',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'panic_sell_smart_trade' => [
        'end_point'     => '/public/api/ver1/smart_trades/panic_sell',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'smart_trade_history' => [
        'end_point'     => '/public/api/ver1/smart_trades',
        'method'        => 'GET',
        'security'      => 'SIGNED'
    ],
    'create_smart_sale' => [
        'end_point'     => '/public/api/ver1/smart_trades/create_smart_sell',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'create_smart_trade' => [
        'end_point'     => '/public/api/ver1/smart_trades/create_smart_trade',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'refresh_smart_trade' => [
        'end_point'     => '/public/api/ver1/smart_trades/{smart_trade_id}/force_process',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'edit_smart_trade' => [
        'end_point'     => '/public/api/ver1/smart_trades/{smart_trade_id}/update',
        'method'        => 'PATCH',
        'security'      => 'SIGNED'
    ],
    'smart_step_panic_sell' => [
        'end_point'     => '/public/api/ver1/smart_trades/{smart_trade_id}/step_panic_sell',
        'method'        => 'POST',
        'security'      => 'SIGNED'
    ],
    'ping' => [
        'end_point'     => '/public/api/ver1/smart_trades/{smart_trade_id}/update',
        'method'        => 'PATCH',
        'security'      => 'SIGNED'
    ],
    'response' => [
        401 => 'Code 401: Api key doesn\'t have enough permissions',
        403 => 'Code 403: Access forbidden',
        429 => 'Code 429: Warning message received! Back off the API or get banned.',
        418 => 'Code 418: IP ADDRESS BANNED!',
        500 => 'Code 500: Internal Server Error',
        504 => 'Code 504: Request Timeout!',
        700 => 'Review this response code'
    ],
];
