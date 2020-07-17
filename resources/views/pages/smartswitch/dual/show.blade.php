@extends('layouts.default')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Dual Bot SmartSwitch</h3>
    </div>
    <div class="box-body">
        What is Dual Bot SmartSwitch? This will allow you to select two bots, one long and the other short and control them via two TradingView alerts. As an example, a TradingView alert could start a long bot. When your indicators indicate it's time to go short, the short bot can be triggered. This feature allows you to take full advantage of all the options that are available. When the switch occurs you can choose to stop the long bot and let it finish the open deal. And of course you can panic sell the position. The same would go for the short bot and the process can go back and forth. Instead of simply starting a new deal, the option to start the bot is available. Checkout your options below.
    </div>
</div>

<form role="form" action="{{ route('smartswitch/dual/store') }}" method="post">
{{ csrf_field() }}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View dual bot</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">Long Bot</label>
                        <input type="text" class="form-control" disabled="" value="{{ $smart_switch_duals->long_bot->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">Short Bot</label>
                        <input type="text" class="form-control" disabled="" value="{{ $smart_switch_duals->short_bot->name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">Switch Action</label>
                        <input type="text" class="form-control" disabled="" value="{{ $smart_switch_duals->switch_action }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" disabled="" value="{{ $smart_switch_duals->name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">Active?</label>
                        <input type="text" class="form-control" disabled="" value="{{ $smart_switch_duals->is_active }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">Enabled?</label>
                        <input type="text" class="form-control" disabled="" value="{{ $smart_switch_duals->is_enabled }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">JSON Long Code</label>
                        <textarea class="form-control" disabled="">{{ $smart_switch_duals->json_long }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="control-label">JSON Short Code</label>
                        <textarea class="form-control" disabled="">{{ $smart_switch_duals->json_short }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
