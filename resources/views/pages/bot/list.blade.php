@extends('layouts.default')

@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Total Bots: {{ count($bots) }}</h3>
    <a disabled href="#" class="btn btn-sm btn-flat btn-danger pull-right">Delete</a>
  </div>
  <div class="box-body table-responsive no-padding">
  <table class="table table-bordered table-striped">
    <thebot>
      <tr>
        <th></th>
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
        <th>E?</th>
        <th>ADC</th>
        <th>BOVT</th>
        <th>SOVT</th>
      </tr>
    </thebot>
    <tbody>
      @foreach($bots as $bot)
        @if ($bot->is_enabled == true)
        <tr style="background-color: #afffb2">
        @else
        <tr>
        @endif
          <td><input type="checkbox"></td>
          <td><a href="{{ route('basic.bot.show', $bot->id ) }}" class="label label-primary" title="Show Bot">{{ $bot->name }}</a></td>
          <td>{{ $bot->strategy }}</td> <!-- rewrite value to Single Long Short Multi,m etc-->
          <td>{{ $bot->pairs }}</td>
          <td>{{ $bot->base_order_volume }}</td>
          <td>{{ $bot->safety_order_volume }}</td>
          <td>{{ $bot->safety_order_step_percentage }}</td>
          <td>{{ $bot->martingale_volume_coefficient }}</td>
          <td>{{ $bot->martingale_step_coefficient }}</td>
          <td>{{ $bot->active_safety_orders_count }}</td>
          <td>{{ $bot->max_safety_orders }}</td>
          <td>{{ $bot->take_profit }}%</td>
          <td>{{ $bot->completed_deals_usd_profit }}</td>
          <td>{{ $bot->active_deals_usd_profit }}</td>
          <td>{{ $bot->total_usd_profit }}</td>
          <td>{{ $bot->max_active_deals }}</td>
          <td>{{ $bot->strategy_list }}</td>
          <td>{{ $bot->take_profit_type }}</td>
          <td>{{ $bot->is_enabled }}</td>
          <td>{{ $bot->active_deals_count }}</td>
          <td>{{ $bot->base_order_volume_type }}</td>
          <td>{{ $bot->safety_order_volume_type }}</td>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
