@extends('layouts.default')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/spreadsheet.css') }}">
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Long Bot Calculator</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group col-md-3">
                <label for="base_order_5">Buy Price:</label>
                <input class="form-control" onkeyup="calculateLongSpreadsheet()" type="text" name="buy_price" id="buy_price" value="0.00000420">
            </div>

            <div class="form-group col-md-3">
                <label for="base_trade">Base Trade:</label>
                <input class="form-control" onkeyup="calculateLongSpreadsheet()" type="text" name="base_trade" id="base_trade" value="0.001" maxlength="10">
            </div>

            <div class="form-group col-md-3">
                <label for="safety_trade">Safety Trade:</label>
                <input class="form-control" onkeyup="calculateLongSpreadsheet()" type="text" name="safety_trade" id="safety_trade" value="0.001">
            </div>

            <div class="form-group col-md-3">
                <label for="btc_price">BTC Price:</label>
                <input class="form-control" onkeyup="calculateLongSpreadsheet()" type="number" name="btc_price" id="btc_price" value="7777">
            </div>

            <div class="form-group col-md-6">
                <label for="target_profit">Target Profit %: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('long', 'target_profit', $(this).val())" value="1.5" id="val_target_profit"></label>
                <input type="text" class="form-control slider" name="target_profit" id="target_profit" value="1.5" data-slider-min="0.2" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1.5" data-slider-id="GC" data-slider-tooltip="none" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="deviation">Deviation: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('long', 'deviation', $(this).val())" value="1" id="val_deviation"></label>
                <input type="text" class="form-control slider" name="deviation" id="deviation" value="" data-slider-min="0.21" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1" data-slider-id="GC" data-slider-tooltip="none" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="safety_vol">Safety Vol: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('long', 'safety_vol', $(this).val())" value="1.5" id="val_safety_vol"></label>
                <input type="text" class="form-control slider" name="safety_vol" id="safety_vol" value="" data-slider-min="0.1" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1.5" data-slider-id="GC" data-slider-tooltip="none" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="safety_step">Safety % Step: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('long', 'safety_step', $(this).val())" value="1.5" id="val_safety_step"></label>
                <input type="text" class="form-control slider" name="safety_vol" id="safety_step" value="" data-slider-min="0.1" data-slider-max="10"
                       data-slider-step="0.01" data-slider-value="1.5" data-slider-id="GC" data-slider-tooltip="none" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-6">
                <label for="base_order_5">Safety Trades: <input type="text" class="form-control" style="width: 55px; display: inline;" onkeyup="changeSliderValue('long', 'safety_trade_count', $(this).val())" value="5" id="val_safety_trade_count"></label>
                <input type="text" class="form-control slider" name="safety_trade_count" id="safety_trade_count" value="" data-slider-min="0" data-slider-max="100"
                       data-slider-step="1" data-slider-value="5" data-slider-id="GC" data-slider-tooltip="none" data-slider-handle="round" >
            </div>
            <!--div class="form-group col-md-4">
                <label for="g3">ADA Free Coin:</label>
                <input class="form-control" onkeyup="calculateLongSpreadsheet()" type="text" name="g3" id="g3" value="10000">
            </div-->

            <div class="form-group col-md-2" style="display:none">
                <label>Total Vol:</label>
                <span id="base_order_1"></span>
            </div>

            <div class="form-group col-md-2" style="display:none">
                <label>BTC/DEAL:</label>
                <span id="base_order_2"></span>
            </div>

            <div class="form-group col-md-2" style="display:none">
                <label>Profit:</label>
                <span id="base_order_3"></span>
            </div>

            <div class="form-group col-md-2" style="display:none">
                <label>Buy Price:</label>
                <span id="buy_price2"></span>
            </div>

            <div class="form-group col-md-2" style="display:none">
                <label>Avg. Price:</label>
                <span id="ave_price"></span>
            </div>

            <div class="form-group col-md-2" style="display:none">
                <label>Sell Price:</label>
                <span id="sell_price"></span>
            </div>

            <table id="tbl_long" class="table table-bordered table-striped table-hover-blue">
                <thead>
                    <th>SO#</th>
                    <th>SO Scale%</th>
                    <th>SO Size</th>
                    <th>Total%</th>
                    <th>BTC</th>
                    <th>Profit</th>
                    <th>Buy Price</th>
                    <th>Avg Price</th>
                    <th>Sell Price</th>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <th>SO#</th>
                    <th>SO Scale%</th>
                    <th>SO Size</th>
                    <th>Total%</th>
                    <th>BTC</th>
                    <th>Profit</th>
                    <th>Buy Price</th>
                    <th>Avg Price</th>
                    <th>Sell Price</th>
                </tfoot>
            </table>
        </div>
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

                calculateLongSpreadsheet();
            });

            calculateLongSpreadsheet();
        });
    </script>
@endsection