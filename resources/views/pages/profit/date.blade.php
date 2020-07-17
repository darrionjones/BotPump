@extends('layouts.default')

@section('content')
    <div class="box box-primary" style="padding: 0.01em 16px;">
        <h2>Profit By Date</h2>

        <div class="w3-row">
            <a href="javascript:void(0)" onclick="openTab(event, 'both');">
                <div id ="tab_both" class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Both</div>
            </a>
            <a href="javascript:void(0)" onclick="openTab(event, 'long');">
                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Long</div>
            </a>
            <a href="javascript:void(0)" onclick="openTab(event, 'short');">
                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Short</div>
            </a>
        </div>

        <div id="both" class="tab" style="display: block;">
            <div class="form-group">
                <div class="form-group col-md-2">
                    <label>Base</label>
                    <select id="base_both" class="select2 base" style="width: 150px;">
                        @foreach($both as $item)
                            <option value="{{ $item->base }}">{{ $item->base }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Pairs</label>
                    <select id="pair_both" class="select2 pair" multiple="multiple" style="width: 300px;"></select>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <button type="button" class="btn btn-default form-control pull-right daterange" id="daterange_both">
                    <span>
                      <i class="fa fa-calendar"></i> Please select date range
                    </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <!-- $().button('toggle'), $().button('dispose') -->
                    <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                        <label class="btn btn-default active" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_both" id="interval_daily_both" autocomplete="off" checked> Daily
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_both" id="interval_weekly_both" autocomplete="off"> Weekly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_both" id="interval_monthly_both" autocomplete="off"> Monthly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_both" id="interval_yearly_both" autocomplete="off"> Yearly
                        </label>
                    </div>
                </div>
            </div>

            <div id="chart_both" style="min-height: 400px; margin: 0 auto"></div>

            <div>
                <table id ="tbl_both" class="table table-bordered table-striped table-hover-blue"></table>
            </div>
        </div>

        <div id="long" class="tab" style="display:none">
            <div class="form-group">
                <div class="form-group col-md-2">
                    <label>Base</label>
                    <select id="base_long" class="select2 base" style="width: 150px;">
                        @foreach($long as $item)
                            <option value="{{ $item->base }}">{{ $item->base }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Pairs</label>
                    <select id="pair_long" class="select2 pair" multiple="multiple" style="width: 300px;"></select>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <button type="button" class="btn btn-default form-control pull-right daterange" id="daterange_long">
                    <span>
                      <i class="fa fa-calendar"></i> Please select date range
                    </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <!-- $().button('toggle'), $().button('dispose') -->
                    <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                        <label class="btn btn-default active" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_long" id="interval_daily_long" autocomplete="off" checked> Daily
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_long" id="interval_weekly_long" autocomplete="off"> Weekly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_long" id="interval_monthly_long" autocomplete="off"> Monthly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_long" id="interval_yearly_long" autocomplete="off"> Yearly
                        </label>
                    </div>
                </div>
            </div>

            <div id="chart_long" style="min-height: 400px; margin: 0 auto"></div>

            <div>
                <table id ="tbl_long" class="table table-bordered table-striped table-hover-blue"></table>
            </div>
        </div>

        <div id="short" class="tab" style="display:none">
            <div class="form-group">
                <div class="form-group col-md-2">
                    <label>Base</label>
                    <select id="base_short" class="select2 base" style="width: 150px;">
                        @foreach($short as $item)
                            <option value="{{ $item->base }}">{{ $item->base }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Pairs</label>
                    <select id="pair_short" class="select2 pair" multiple="multiple" style="width: 300px;"></select>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <button type="button" class="btn btn-default form-control pull-right daterange" id="daterange_short">
                    <span>
                      <i class="fa fa-calendar"></i> Please select date range
                    </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <!-- $().button('toggle'), $().button('dispose') -->
                    <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                        <label class="btn btn-default active" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_short" id="interval_daily_short" autocomplete="off" checked> Daily
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_short" id="interval_weekly_short" autocomplete="off"> Weekly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_short" id="interval_monthly_short" autocomplete="off"> Monthly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval" name="interval_short" id="interval_yearly_short" autocomplete="off"> Yearly
                        </label>
                    </div>
                </div>
            </div>

            <div id="chart_short" style="min-height: 400px; margin: 0 auto"></div>

            <div>
                <table id ="tbl_short" class="table table-bordered table-striped table-hover-blue"></table>
            </div>
        </div>

        <div class="overlay" style="display: none;">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/profit.js') }}"></script>
    <script>
        var columns = {
            "columns": [
                { "title": "#", "data": "number" },
                { "title": "Interval", "data": "intval" },
                { "title": "Pair", "data": "pair" },
                { "title": "Total Deal", "data": "total_deals" },
                { "title": "Total Profit", "data": "total_profit" }
            ],
            "columnDefs": [ {
                "targets": 0,
                "data": "number",
                "render": rowNum
            } ]
        };
        var rangePickerOptions = {
            opens: "right",
            ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        };

        var rangeStartBoth, rangeEndBoth, rangeStartLong, rangeEndLong, rangeStartShort, rangeEndShort;
        var intervalBoth = intervalLong = intervalShort = "daily";
        var pairsBoth = pairsLong = pairsShort = [];
        var baseBoth = baseLong = baseShort = "";

        function rowNum(data, type, row, meta) {
            return meta.row + 1;
        }

        function makeReport(dealType) {
            $('.overlay').show();

            if (dealType == "%") {
                interval = intervalBoth;
                pairs = pairsBoth;
                rangeStart = rangeStartBoth;
                rangeEnd = rangeEndBoth;
                base = baseBoth;
            } else if (dealType == "Deal") {
                interval = intervalLong;
                pairs = pairsLong;
                rangeStart = rangeStartLong;
                rangeEnd = rangeEndLong;
                base = baseLong;
            } else if (dealType == "Deal::ShortDeal") {
                interval = intervalShort;
                pairs = pairsShort;
                rangeStart = rangeStartShort;
                rangeEnd = rangeEndShort;
                base = baseShort;
            }

            $.post("{{ route('profit/getProfitByDate') }}", {
                "_token" : "{{ csrf_token() }}",
                "base" : base,
                "pair" : pairs,
                "strategy" : dealType,
                "start" : rangeStart != null ? rangeStart.format('YYYY-MM-DD 00:00:00') : "",
                "end" : rangeEnd != null ?  rangeEnd.format('YYYY-MM-DD 23:59:59') : "",
                "interval" : interval,
                "api_key" : "{{ $api_key }}",
            }, function (response) {
                var categories = [];
                var series = [];
                response.forEach(function (row, index) {
                    if (categories.indexOf(row.intval) < 0) {
                        categories.push(row.intval);
                    }

                    var sIndex = series.findIndex(i => i.name === row.pair);
                    if (sIndex < 0) {
                        series.push({name: row.pair, data: []});
                    }
                });

                categories.forEach(function (category, index) {
                    series.forEach(function (serie, index) {
                        var index = response.findIndex(i => i.intval === category && i.pair === serie.name);
                        if (index > -1)
                            serie.data.push(response[index].total_profit);
                        else
                            serie.data.push(0);
                    });
                });

                console.log(categories);
                console.log(series);

                var chartId = "chart_both";
                if (dealType == "%") {
                    $tableBoth.clear();
                    $tableBoth.rows.add(response);
                    $tableBoth.draw();
                } else if (dealType == "Deal::ShortDeal") {
                    $tableShort.clear();
                    $tableShort.rows.add(response);
                    $tableShort.draw();

                    chartId = "chart_short";
                } else if (dealType == "Deal") {
                    $tableLong.clear();
                    $tableLong.rows.add(response);
                    $tableLong.draw();

                    chartId = "chart_long";
                }


                Highcharts.chart(chartId, {
                    chart: {
                        type: 'column',
                        padding: [0,0,0,0]
                    },
                    plotOptions: {
                        column: {
                            groupPadding: 0
                        }
                    },
                    title: {
                        text: 'Profit By Date, Grouped By Quote'
                    },
                    yAxis: {
                        title: {
                            text: 'Total profit'
                        },
                        tickInterval: 0.0001
                    },
                    xAxis: {
                        categories: categories
                    },
                    credits: {
                        enabled: false
                    },
                    series: series
                });

                $('.overlay').hide();
            });
        }

        function updateBasePairs(strategy, base) {
            $.post("{{ route('profit/getBasePair') }}", {
                "_token" : "{{ csrf_token() }}",
                "base" : base,
                "strategy" : strategy,
                "api_key" : "{{ $api_key }}",
            }, function (response) {
                var pairId = "pair_both";

                if (strategy == "%") {
                    pairId = "pair_both";
                    pairsBoth = [];
                } else if (strategy == "Deal") {
                    pairId = "pair_long";
                    pairsLong = [];
                } else if (strategy == "Deal::ShortDeal") {
                    pairId = "pair_short";
                    pairsShort = [];
                }
                $('#' + pairId).empty();
                response.forEach(function (row, index) {
                    $('#' + pairId).append('<option value="' + row.pair + '">' + row.pair + '</option>');
                });
                makeReport(strategy);
            });
        }

        $(function () {
            $tableBoth = $('#tbl_both').DataTable(columns);
            $tableLong = $('#tbl_long').DataTable(columns);
            $tableShort = $('#tbl_short').DataTable(columns);

            $('#daterange_both').daterangepicker(rangePickerOptions, function (start, end) {
                $('#daterange_both span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                rangeStartBoth = start; rangeEndBoth = end;
                makeReport("%");
            });

            $('#daterange_long').daterangepicker(rangePickerOptions, function (start, end) {
                $('#daterange_long span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                rangeStartLong = start; rangeEndLong = end;
                makeReport("Deal");
            });

            $('#daterange_short').daterangepicker(rangePickerOptions, function (start, end) {
                $('#daterange_short span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                rangeStartShort = start; rangeEndShort = end;
                makeReport("Deal::ShortDeal");
            });

            $('.interval').on('change', function () {
                strategy = $(this).attr('id').split("_")[2];

                if (strategy == "long") {
                    intervalLong = $(this).attr('id').split("_")[1];
                    makeReport("Deal");
                } else if (strategy == "short") {
                    intervalShort = $(this).attr('id').split("_")[1];
                    makeReport("Deal::ShortDeal");
                } else {
                    intervalBoth = $(this).attr('id').split("_")[1];
                    makeReport("%");
                }
            });

            $('.pair').select2().on('change', function () {
                strategy = $(this).attr('id').split("_")[1];
                if (strategy == "long") {
                    pairsLong = $(this).val();
                    makeReport("Deal");
                } else if (strategy == "short") {
                    pairsShort = $(this).val();
                    makeReport("Deal::ShortDeal");
                } else {
                    pairsBoth = $(this).val();
                    makeReport("%");
                }
            });

            $('.base').select2().on('change', function () {
                var strategy = $(this).attr('id').split("_")[1];
                if (strategy == "long") {
                    baseLong = $(this).val();
                    updateBasePairs("Deal", baseLong);
                } else if (strategy == "short") {
                    baseShort = $(this).val();
                    updateBasePairs("Deal::ShortDeal", baseShort);
                } else {
                    baseBoth = $(this).val();
                    updateBasePairs("%", baseBoth);
                }
            });

            @if (sizeof($both) > 0)
            $('#base_both').val('{{ $both[0]->base }}').trigger('change');
            baseBoth = '{{ $both[0]->base }}';
            @endif

            @if (sizeof($long) > 0)
            $('#base_long').val('{{ $long[0]->base }}').trigger('change');
            baseLong = '{{ $long[0]->base }}';
            @endif

            @if (sizeof($short) > 0)
            $('#base_short').val('{{ $short[0]->base }}').trigger('change');
            baseShort = '{{ $short[0]->base }}';
            @endif
        });
    </script>
@endsection