@extends('layouts.default')

@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Deal ID: {{ $deal->id }}</h3>
    <div class="pull-right"><a href="{{ route('basic.bot.show', $deal->bot_id ) }}" class="label label-primary" title="Show Bot">{{ $deal->bot_name }}</a></div>
  </div>
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Type</th>
          <th>Pair</th>
          <th>Profit</th>
          <th>$ Profit</th>
          <th>Closed</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $deal->type }}</td>
          <td>{{ $deal->pair }}</td>
          <td>{{ $deal->final_profit }}</td>
          <td>${{ $deal->usd_final_profit }}</td>
          <td>{{ $deal->closed_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Bot Settings Used</h3>
  </div>
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>BO</th>
          <th>SO</th>
          <th>SOS</th>
          <th>MC</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $deal->base_order_volume }} {{$deal->base_order_volume_type }}</td>
          <td>{{ $deal->safety_order_volume }} {{ $deal->safety_order_volume_type }}</td>
          <td>{{ $deal->safety_order_step_percentage }}</td>
          <td>{{ $deal->martingale_coefficient }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Profit Details</h3>
  </div>
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Take Profit</th>
          <th>Profit Type</th>
          <th>Actual TP%</th>
          <th>Actual Profit</th>
          <th>Actual USD</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $deal->take_profit }}%</td>
          <td>{{ $deal->take_profit_type }}</td>
          <td>{{ $deal->actual_profit_percentage }}</td>
          <td>{{ $deal->actual_profit }}</td>
          <td>{{ $deal->actual_usd_profit }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Trade Details</h3>
  </div>
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Bought / Sold Volume</th>
          <th>Bought / Sold Amount</th>
          <th>Used Safety</th>
          <th>Max Safety</th>
          <th>Average Price</th>
          <th>Take Profit Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $deal->bought_volume }} / {{ $deal->sold_volume }}</td>
          <td>{{ $deal->bought_amount }} / {{ $deal->sold_amount }}</td>
          <td>{{ $deal->completed_safety_orders_count }}</td>
          <td>{{ $deal->max_safety_orders }}</td>
          <td>{{ $deal->bought_average_price }}</td>
          <td>{{ $deal->take_profit_price }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection
