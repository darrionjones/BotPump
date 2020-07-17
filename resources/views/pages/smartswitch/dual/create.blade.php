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
            <h3 class="box-title">Create a dual bot</h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="long_bot_id" class="control-label">Long Bots</label>
                            <select class="form-control required" id="long_bot_id" name="long_bot_id">
                            <option value="" disabled selected hidden>Choose One</option>
                            @foreach ($all_long_bots as $l_bot)
                                <option value="{{$l_bot->id}}">
                                    {{ $l_bot->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('long_bot_id'))
                            <div class="help-block" style="color: red;">{{ $errors->first('long_bot_id') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="short_bot_id" class="control-label">Short Bots</label>
                        <select class="form-control required" id="short_bot_id" name="short_bot_id">
                        <option value="" disabled selected hidden>Choose One</option>
                            @foreach ($all_short_bots as $s_bot)
                                <option value="{{$s_bot->id}}">
                                    {{ $s_bot->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('short_bot_id'))
                            <div class="help-block" style="color: red;">{{ $errors->first('short_bot_id') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="long_switch_action" class="control-label">On long bot reversal the open deal should...</label>
                        <select class="form-control required" id="long_switch_action" name="long_switch_action">
                                <option value="" disabled selected hidden>Choose One</option>
                                <option value="cancel">Cancel</option>
                                <option value="panic">Panic</option>
                                <option value="change_tp">Change TP</option>
                                <option value="do_nothing">Do Nothing</option>
                        </select>
                        @if ($errors->has('long_switch_action'))
                            <div class="help-block" style="color: red;">{{ $errors->first('long_switch_action') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="short_switch_action" class="control-label">On short bot reversal the open deal should...</label>
                        <select class="form-control required" id="short_switch_action" name="short_switch_action">
                                <option value="" disabled selected hidden>Choose One</option>
                                <option value="cancel">Cancel</option>
                                <option value="panic">Panic</option>
                                <option value="change_tp">Change TP</option>
                                <option value="do_nothing">Do Nothing</option>
                        </select>
                        @if ($errors->has('short_switch_action'))
                            <div class="help-block" style="color: red;">{{ $errors->first('short_switch_action') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="first_long_deal" class="control-label">How to open the first long bot of a switch...</label>
                        <select class="form-control required" id="first_long_deal" name="first_long_deal">
                                <option value="" disabled selected hidden>Choose One</option>
                                <option value="enable">Enable</option>
                                <option value="asap">ASAP</option>
                                <option value="asap_enable">ASAP & Enable</option>
                        </select>
                        @if ($errors->has('long_bot_id'))
                            <div style="color: red;">{{ $errors->first('long_bot_id') }}</div>
                        @endif
                            {!! $errors->first('first_long_deal', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="first_short_deal" class="control-label">How to open the first short bot of a switch...</label>
                        <select class="form-control required" id="first_short_deal" name="first_short_deal">
                                <option value="" disabled selected hidden>Choose One</option>
                                <option value="enable">Enable</option>
                                <option value="asap">ASAP</option>
                                <option value="asap_enable">ASAP & Enable</option>
                        </select>
                        @if ($errors->has('long_bot_id'))
                            <div style="color: red;">{{ $errors->first('long_bot_id') }}</div>
                        @endif
                            {!! $errors->first('first_short_deal', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="name" class="control-label">Dual SmartSwitch Name</label>
                        <input type="text" class="form-control" placeholder="Name" id ="name" name="name">
                        @if ($errors->has('long_bot_id'))
                            <div style="color: red;">{{ $errors->first('long_bot_id') }}</div>
                        @endif
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="is_enabled" class="control-label">Enable this SmartSwitch now?</label><br>
                        <label class="switch">
                            <input type="checkbox" class="is_enabled" id="is_enabled" name="is_enabled">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-footer">
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-sm btn-flat btn-success pull-right">Create & Get JSON Code</button>
        </div>
    </div>
</form>
@endsection
