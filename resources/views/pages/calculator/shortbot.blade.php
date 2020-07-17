@extends('layouts.default')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/spreadsheet.css') }}">
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Short Bot Calculator</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group col-md-2">
                <label for="base_order_5">Sell Price:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="base_order_5" id="base_order_5" value="0.0004747">
            </div>

            <div class="form-group col-md-3">
                <label for="base_trade">Base Trade:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="base_trade" id="base_trade" value="0.001">
            </div>

            <div class="form-group col-md-3">
                <label for="safety_trade">Safety Trade:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="safety_trade" id="safety_trade" value="0.001">
            </div>

            <div class="form-group col-md-2">
                <label for="btc_price">BTC:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="btc_price" id="btc_price" value="7777">
            </div>

            <div class="form-group col-md-2">
                <label for="g3">Coins:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="g3" id="g3" value="314159">
            </div>

            <div class="form-group col-md-6">
                <label for="target_profit">Target Profit: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'target_profit', $(this).val())" min="0.2" max="10" value="1.5" id="val_target_profit"></label>
                <input type="text" class="form-control slider" name="target_profit" id="target_profit" value="" data-slider-min="0.2" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1.5" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="deviation">Deviation: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'deviation', $(this).val())" value="1" id="val_deviation"></label>
                <input type="text" class="form-control slider" name="deviation" id="deviation" value="" data-slider-min="0.21" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="safety_vol">Safety Vol: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'safety_vol', $(this).val())" value="1" id="val_safety_vol"></label>
                <input type="text" class="form-control slider" name="safety_vol" id="safety_vol" value="" data-slider-min="0.1" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="safety_step">Safety % Step: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'safety_step', $(this).val())" value="1" id="val_safety_step"></label>
                <input type="text" class="form-control slider" name="safety_vol" id="safety_step" value="1" data-slider-min="0.1" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="base_order_5">Safety Trades: <input type="text" class="form-control" style="width: 50px; display: inline;" onkeyup="changeSliderValue('short', 'safety_trade_count', $(this).val())" value="5" id="val_safety_trade_count"></label>
                <input type="text" class="form-control slider" name="safety_trade_count" id="safety_trade_count" value="" data-slider-min="0" data-slider-max="100"
                       data-slider-step="1" data-slider-value="5" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-2" style="display:none;">
                <label>Total Vol:</label>
                <span id="base_order_1"></span>
            </div>

            <div class="form-group col-md-2" style="display:none;">
                <label>Profit:</label>
                <span id="base_order_2"></span>
            </div>

            <div class="form-group col-md-2" style="display:none;">
                <label>Total Coins:</label>
                <span id="base_order_3"></span>
            </div>

            <div class="form-group col-md-2" style="display:none;">
                <label>Coin Qty:</label>
                <span id="base_order_4"></span>
            </div>

            <div class="form-group col-md-2" style="display:none;">
                <label>Ave Price:</label>
                <span id="base_order_6"></span>
            </div>

            <div class="form-group col-md-2" style="display:none;">
                <label>Buy Price:</label>
                <span id="base_order_7"></span>
            </div>

            <table id="tbl_short" class="table table-bordered table-striped table-hover-blue">
                <thead>
                    <th>SO#</th>
                    <th>SO Scale%</th>
                    <th>SO Size</th>
                    <th>Price Rise%</th>
                    <th>Total Vol</th>
                    <th>Profit</th>
                    <th>Total Coins</th>
                    <th>Coin Qty</th>
                    <th>Sell Price</th>
                    <th>Avg Price</th>
                    <th>Buy Price</th>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <th>SO#</th>
                    <th>SO Scale%</th>
                    <th>SO Size</th>
                    <th>Price Rise%</th>
                    <th>Total Vol</th>
                    <th>Profit</th>
                    <th>Total Coins</th>
                    <th>Coin Qty</th>
                    <th>Sell Price</th>
                    <th>Avg Price</th>
                    <th>Buy Price</th>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/spreadsheet.js') }}"></script>

    <script>
        $(function() {
            $('.slider').slider().on('slide', function (e) {
                var id = $(this).attr('id');
                if (id != "safety_trade_count") {
                    var value = $(this).data('slider').getValue().toFixed(2);
                } else {
                    var value = $(this).data('slider').getValue();
                }
                $('#val_' + id).val(value);

                calculateShortSpreadsheet();
            });

            calculateShortSpreadsheet();
        });
    </script>
@endsection