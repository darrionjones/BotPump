@extends('layouts.default')

@section('content')
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total<br>Deals</span>
          <span id="completed_deals" class="info-box-number">{{ $completed_deals > 0 ? number_format($completed_deals) : '0' }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-bolt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active<br>Deals</span>
          <span id="active_deals"  class="info-box-number">{{ $active_deals > 0 ? number_format($active_deals) : '0' }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-rocket"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total<br>Bots</span>
          <span id="bot_count" class="info-box-number">{{ $bot_count > 0 ? number_format($bot_count) : '0' }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-exclamation-triangle"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active<br>Bots</span>
          <span id="active_bots" class="info-box-number">{{ $active_bots > 0 ? number_format($active_bots) : '0' }}</span>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Total Profits</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table id="tbl_dashboard" class="table table-bordered table-striped table-hover-blue">
          <thead>
            <tr>
              <th>Currency</th>
              <th>Profit</th>
              <th>Pairs</th>
              <th>Completed</th>
              <th>Panics</th>
              <th>Stops</th>
              <th>Switched</th>
              <th>Failed</th>
              <th>Cancelled</th>
              <th style="background-color: #3c8dbc30; font-weight: bold;">Deals</th>
            </tr>
          </thead>
          <tbody>
          @if ($completed_deals > 0)
            @foreach ($base_profit as $total)
              @if ($total->base === '')
              <tr style="background-color: #3c8dbc30; font-weight: bold;">
                @else
                <tr>
                  @endif
                <td>
                  @if ($total->base != '')
                    <img src="{{ asset('img/coins/' . strtolower($total->base) . '.png') }}" height="22px"> <span class="label bg-gray">{{ $total->base }}</span>
                  @else
                    Total
                  @endif
                </td>
                <td><span style="font-weight: bold;">{{ $total->profit }}</span></td>
                <td>{{ $total->unique }}</td>
                <td>{{ $total->completed }}</td>
                <td>{{ $total->panic }}</td>
                <td>{{ $total->stop }}</td>
                <td>{{ $total->switched }}</td>
                <td>{{ $total->failed }}</td>
                <td>{{ $total->cancelled }}</td>
                <td style="background-color: #3c8dbc30; font-weight: bold;">{{ $total->actual }}</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <div class="pull-right">
          Cancel All | Panic Sell All
        </div>
        <h3 class="box-title">Active Deals</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover-blue">
            <thead><tr>
            <th>ID / Bot</th>
            <th>Pair</th>
            <th>BO</th>
            <th>SO</th>
            <th>SOS</th>
            <th>MC</th>
            <th colspan="3">Safety Trades</th>
            <th>TP</th>
            <th>C PS</th>
            </tr></thead>
          <tbody>
          @if (count($active_deals_list) > 1)
            @foreach ($active_deals_list as $ad)
                <td><a href="{{ route('basic.deal.show', $ad->id ) }}" class="label label-primary" title="Show Deal">{{ $ad->id }}</a><br>
                  <a href="{{ route('basic.bot.show', $ad->bot_id ) }}" class="label label-primary" title="Show Bot">{{ $ad->bot_name }}</a></td>
                <td>{{ $ad->pair }}</td>
                <td>{{ $ad->base_order_volume }}</td>
                <td>{{ $ad->safety_order_volume }}</td>
                <td>{{ $ad->safety_order_step_percentage }}</td>
                <td>{{ $ad->martingale_coefficient }}</td>
                <td>{{ $ad->completed_safety_orders_count }}</td>
                <td>{{ $ad->active_safety_orders_count }}</td>
                <td>{{ $ad->max_safety_orders }}</td>
                <td>{{ $ad->take_profit }}%</td>
                <td>C PS</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
        </tbody></table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title">Active Bots</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover-blue">
            <thead><tr>
                <th>Name</th>
                <th>Strategy</th>
                <th>Pairs</th>
                <th>BO</th>
                <th>SO</th>
                <th>SOS%</th>
                <th>Vol</th>
                <th>SC</th>
                <th>SOC</th>
                <th>Max Safe</th>
                <th>Take Profit</th>
                <th>Completed USD</th>
                <th>ADP</th>
                <th>TUP</th>
                <th>MAD</th>
                <th>SL</th>
                <th>TPT</th>
                <th>ADC</th>
                <th>BOVT</th>
                <th>SOVT</th>
            </tr></thead>
          <tbody>
          @if (count($active_bots_list) > 1)
            @foreach ($active_bots_list as $abl)
                <td><a href="{{ route('basic.bot.show', $abl->id ) }}" class="label label-primary" title="Show Bot">{{ $abl->name }}</a></td>
                <td>{{ $abl->strategy }}</td> <!-- rewrite value to Single Long Short Multi,m etc-->
                <td>{{ $abl->pairs }}</td>
                <td>{{ $abl->base_order_volume }}</td>
                <td>{{ $abl->safety_order_volume }}</td>
                <td>{{ $abl->safety_order_step_percentage }}</td>
                <td>{{ $abl->martingale_volume_coefficient }}</td>
                <td>{{ $abl->martingale_step_coefficient }}</td>
                <td>{{ $abl->active_safety_orders_count }}</td>
                <td>{{ $abl->max_safety_orders }}</td>
                <td>{{ $abl->take_profit }}%</td>
                <td>{{ $abl->completed_deals_usd_profit }}</td>
                <td>{{ $abl->active_deals_usd_profit }}</td>
                <td>{{ $abl->total_usd_profit }}</td>
                <td>{{ $abl->max_active_deals }}</td>
                <td>{{ $abl->strategy_list }}</td>
                <td>{{ $abl->take_profit_type }}</td>
                <td>{{ $abl->active_deals_count }}</td>
                <td>{{ $abl->base_order_volume_type }}</td>
                <td>{{ $abl->safety_order_volume_type }}</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
        </tbody></table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Recently Completed Deals</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover-blue">
            <thead><tr>
                <th>ID / Bot</th>
                <th>Pair</th>
                <th>BO</th>
                <th>SO</th>
                <th>SOS</th>
                <th>MC</th>
                <th colspan="3">Safety Trades</th>
                <th>TP</th>
                <th>Final Profit</th>
            </tr></thead>
          <tbody>
          @if (count($recent_completed_deals) > 1)
            @foreach ($recent_completed_deals as $rd)
                <td><a href="{{ route('basic.deal.show', $rd->id ) }}" class="label label-primary" title="Show Deal">{{ $rd->id }}</a><br>
                  <a href="{{ route('basic.bot.show', $rd->bot_id ) }}" class="label label-primary" title="Show Bot">{{ $rd->bot_name }}</a></td>
                <td>{{ $rd->pair }}</td>
                <td>{{ $rd->base_order_volume }}</td>
                <td>{{ $rd->safety_order_volume }}</td>
                <td>{{ $rd->safety_order_step_percentage }}</td>
                <td>{{ $rd->martingale_coefficient }}</td>
                <td>{{ $rd->completed_safety_orders_count }}</td>
                <td>{{ $rd->active_safety_orders_count }}</td>
                <td>{{ $rd->max_safety_orders }}</td>
                <td>{{ $rd->take_profit }}%</td>
                <td>{{ $rd->final_profit }}</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
        </tbody></table>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
  @if (session()->has('load_deal'))
    <script>
        function updateDashboard() {
            $.get('{{ route('dashboard/data') }}', function (response) {
                waitingDialog.hide();

                if (response.completed_deals > 0)
                    $('#completed_deals').text(response.completed_deals);
                else
                    $('#completed_deals').text('?');

                if (response.active_deals > 0)
                    $('#active_deals').text(response.active_deals);
                else
                    $('#active_deals').text('?');

                if (response.bot_count > 0)
                    $('#bot_count').text(response.bot_count);
                else
                    $('#bot_count').text('?');

                if (response.active_bots > 0)
                    $('#active_bots').text(response.active_bots);
                else
                    $('#active_bots').text('?');

                $('#tbl_dashboard tbody').empty();
                if (response.completed_deals > 0) {
                    response.base_profit.forEach(function (row, index) {
                        if (row.base == '')
                            tr = '<tr style="background-color: #3c8dbc30; font-weight: bold;">' +
                                '<td></td>';
                        else
                            tr = '<tr>' +
                                '<td><img src="{{ asset('img/coins/') }}/' + row.base.toLowerCase() + '.png" height="22px"> <span class="label bg-gray">' + row.base + '</span></td>';

                        tr += '<td><span style="font-weight: bold;">' + row.profit + '</span></td>' +
                            '<td>' + row.unique + '</td>' +
                            '<td>' + row.completed + '</td>' +
                            '<td>' + row.panic + '</td>' +
                            '<td>' + row.stop + '</td>' +
                            '<td>' + row.switched + '</td>' +
                            '<td>' + row.failed + '</td>' +
                            '<td>' + row.cancelled + '</td>' +
                            '<td style="background-color: #3c8dbc30; font-weight: bold;">' + row.actual + '</td>' +
                            '</tr>';

                        $('#tbl_dashboard tbody').append(tr);
                    });
                } else {
                    $('#tbl_dashboard tbody').append('<tr><td colspan="47">No Data Available</td></tr>');
                }
            });
        }

        /*
        waitingDialog.show('Please wait while downloading');
        var dealLoaded = false, botLoaded = false;
        $.get('{{ route('3commas/loadDeal') }}', function (response) {
            console.log(response);
            dealLoaded = true;
            if (dealLoaded && botLoaded)
                updateDashboard();
        });

        $.get('{{ route('3commas/loadBots') }}', function (response) {
            console.log(response);
            botLoaded = true;
            if (dealLoaded && botLoaded)
                updateDashboard();
        });
        */
    </script>
  @endif
    <script>
        /*
        $.post('{{ route ('3commas/panicSellDeal', ['deal_id' => 11503406]) }}', {
            "_token" : "{{ csrf_token() }}"
        }, function (response) {
            console.log(response);
            updateDashboard();
        });
        $.post('{{ route ('3commas/cancelDeal', ['deal_id' => 11503406]) }}', {
            "_token" : "{{ csrf_token() }}"
        }, function (response) {
            console.log(response);
            updateDashboard();
        });
        */
        /*
        $.post('{{ route ('3commas/disableBot', ['bot_id' => 97053]) }}', {
            "_token" : "{{ csrf_token() }}"
        }, function (response) {
            console.log(response);
            updateDashboard();
        });
        $.post('{{ route ('3commas/enableBot', ['bot_id' => 34682]) }}', {
            "_token" : "{{ csrf_token() }}"
        }, function (response) {
            console.log(response);
            updateDashboard();
        });
        $.post('{{ route ('3commas/startNewDeal', ['bot_id' => 34682]) }}', {
            "_token" : "{{ csrf_token() }}"
        }, function (response) {
            console.log(response);
            updateDashboard();
        });
        */
    </script>
@endsection
