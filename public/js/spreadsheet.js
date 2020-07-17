function changeSliderValue(bot, slider, value) {
    $('#'+slider).slider().data('slider').setValue(value);
    if (bot == 'short')
        calculateShortSpreadsheet();
    else if (bot == 'long')
        calculateLongSpreadsheet();
}

function calculateShortSpreadsheet() {
    $('#tbl_short tbody').empty();
    var B2 = parseFloat($('#val_target_profit').val());
    var E5 = parseFloat($('#base_trade').val());
    var F3 = parseFloat($('#btc_price').val());
    var base_order_2 = ((E5 * (B2 / 100)) * F3).toFixed(2);
    var I5 = parseFloat($('#base_order_5').val());

    var base_order_4 = ((E5 * 1.01082) / I5).toFixed(2);
    $('#base_order_1').val(B2);

    $('#base_order_1').text($('#base_trade').val());
    $('#base_order_2').text('$' + base_order_2);
    $('#base_order_4').text(base_order_4);
    $('#base_order_3').text($('#base_order_4').text());
    $('#base_order_6').text($('#base_order_5').val());

    var base_order_7 = (I5 * (100 - (B2 + 0.2))) / 100; //(I5*(100-(B2+0.2)))/100;
    $('#base_order_7').text(base_order_7.toFixed(8));

    var safety_trade_count = $('#safety_trade_count').data('slider').getValue();

    var E3 = parseFloat($('#val_safety_step').val());

    var newRow =
            "<tr>" +
            "<td>Base</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "</tr>";
        $('#tbl_short tbody').append(newRow);

    for (var i = 0; i < safety_trade_count; i++) {
        if (i > 0) {
            var BH4OLD = BH4;
            var BH1 = BH1 * E3;
            var BH2 = BH2 * parseFloat($('#val_safety_vol').val());
            var BH3 = BH3 + BH1;
            var BH4 = BH4 + BH2;
            var BH5 = (BH4 * (parseFloat($('#val_target_profit').val()) / 100)) * parseFloat($('#btc_price').val());
            var BH8 = BH8 * (100 + BH1) / 100;
            var BH7 = BH2 / BH8;
            var BH6 = BH7 + BH6;

            var BH9_A = parseFloat(BH9 * BH4OLD);
            var BH9_B = parseFloat(BH8 * BH2);
            var BH9_C = parseFloat(BH9_A + BH9_B);
            var BH9 = parseFloat(BH9_C / BH4);

            var BH10 = (BH9 * (100 - (parseFloat($('#val_target_profit').val()) + 0.2))) / 100;
        } else {
            var BH1 = parseFloat($('#val_deviation').val());
            var BH2 = parseFloat($('#safety_trade').val());
            var BH3 = BH1;
            var BH4 = parseFloat($('#base_order_1').text()) + BH2;
            var BH5 = (BH4 * (parseFloat($('#val_target_profit').val()) / 100)) * parseFloat($('#btc_price').val());
            var BH8 = parseFloat($('#base_order_5').val()) * (100 + BH1) / 100;
            var BH7 = BH2 / BH8;
            var BH6 = BH7 + parseFloat($('#base_order_3').text());

            var BH9_A = parseFloat($('#base_order_6').text() * $('#base_order_1').text());
            var BH9_B = parseFloat(BH8 * BH2);
            var BH9_C = parseFloat(BH9_A + BH9_B);
            var BH9 = parseFloat(BH9_C / BH4);

            var BH10 = (BH9 * (100 - (parseFloat($('#val_target_profit').val()) + 0.2))) / 100;
        }

        newRow =
            "<tr>" +
            "<td>" + (i + 1) + "</td>" +
            "<td>" + BH1.toFixed(2) + "</td>" +
            "<td>" + BH2.toFixed(5) + "</td>" +
            "<td>" + BH3.toFixed(2) + "</td>" +
            "<td>" + BH4.toFixed(5) + "</td>" +
            "<td>" + "$" + BH5.toFixed(2) + "</td>" +
            "<td>" + BH6.toFixed(2) + "</td>" +
            "<td>" + BH7.toFixed(2) + "</td>" +
            "<td>" + BH8.toFixed(8) + "</td>" +
            "<td>" + BH9.toFixed(8) + "</td>" +
            "<td>" + BH10.toFixed(8) + "</td>" +
            "</tr>";
        $('#tbl_short tbody').append(newRow);
    }
}

function calculateLongSpreadsheet() {
    $('#tbl_long tbody').empty();
    $('#base_order_1').text('0.00');
    $('#base_order_2').text($('#base_trade').val());
    $('#base_order_3').text($('#base_trade').val());
    $('#base_trade_value').val($('#base_trade').val());
    $('#safety_trade_value').val($('#safety_trade').val());
    $('#target_profit_value').val($('#target_profit').val());
    $('#deviation_value').val($('#val_deviation').val());
    $('#safety_vol_value').val($('#val_safety_vol').val());
    $('#safety_step_value').val($('#safety_step').val());
    $('#ave_price').text($('#buy_price').val());
    var buyPrice = $('#buy_price').val();
    $('#buy_price2').text(buyPrice);
    var targetProfit = parseFloat($('#target_profit').val()) + 0.2;
    var sell_price = (buyPrice * (100 + targetProfit)) / 100;
    $('#sell_price').text(sell_price.toFixed(8));
    var safety_trade_count = $('#val_safety_trade_count').val();
    var base_profit = parseFloat(($('#base_trade').val() * parseFloat($('#val_target_profit').val()) / 100) * parseFloat($('#btc_price').val()));
    base_profit = base_profit.toFixed(2);

    var newRow =
            "<tr>" +
            "<td>Base</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>-</td>" +
            "<td>" + $('#base_trade').val() + "</td>" +
            "<td>$" + base_profit + "</td>" +
            "<td>" + buyPrice + "</td>" +
            "<td>-</td>" +
            "<td>" + $('#sell_price').text() + "</td>" +
            "</tr>";
        $('#tbl_long tbody').append(newRow);

    for (var i = 0; i < safety_trade_count; i++) {
        if (i > 0) {
            var BH4Old = BH4;
            var BH1 = parseFloat(BH1 * parseFloat($('#val_safety_step').val()));
            var BH2 = parseFloat(BH2 * parseFloat($('#val_safety_vol').val()));
            var BH3 = parseFloat(BH1 + BH3);
            var BH4 = parseFloat(BH2 + BH4);
            var BH5 = parseFloat((BH4 * parseFloat($('#val_target_profit').val()) / 100) * parseFloat($('#btc_price').val()));
            var BH6 = parseFloat((BH6 * (100 - BH1)) / 100);
            var BH7 = parseFloat(((BH7 * BH4Old) + (BH6 * BH2)) / BH4);
            var BH8 = parseFloat((BH7 * (100 + (parseFloat($('#val_target_profit').val()) + 0.2))) / 100);
        } else {
            var BH1 = parseFloat($('#val_deviation').val());
            var BH2 = parseFloat($('#safety_trade').val());
            var BH3 = parseFloat(BH1);
            var BH4 = parseFloat($('#base_order_2').text()) + BH2;

            var BH5_1 = parseFloat($('#val_target_profit').val()) / 100;
            var BH5_11 = parseFloat(BH4 * BH5_1);
            var BH5_2 = parseFloat($('#btc_price').val());
            var BH5 = parseFloat(BH5_11 * BH5_2);

            var BH6 = parseFloat((parseFloat($('#buy_price').val()) * (100 - BH1)) / 100);
            var BH7 = parseFloat(((parseFloat($('#ave_price').text()) * parseFloat($('#base_order_2').text())) + (BH6 * BH2)) / BH4);
            var BH8 = parseFloat((BH7 * (100 + (parseFloat($('#val_target_profit').val()) + 0.2))) / 100);
        }

        newRow =
            "<tr>" +
            "<td>" + (i + 1) + "</td>" +
            "<td>" + BH1.toFixed(2) + "</td>" +
            "<td>" + BH2.toFixed(4) + "</td>" +
            "<td>" + BH3.toFixed(2) + "</td>" +
            "<td>" + BH4.toFixed(5) + "</td>" +
            "<td>" + "$" + BH5.toFixed(2) + "</td>" +
            "<td>" + BH6.toFixed(8) + "</td>" +
            "<td>" + BH7.toFixed(8) + "</td>" +
            "<td>" + BH8.toFixed(8) + "</td>" +
            "</tr>";
        $('#tbl_long tbody').append(newRow);
    }
}