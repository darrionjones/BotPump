@extends('layouts.default')

@section('content')

  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Bot Details: {{ $bot->name }}</h3>
    </div>
    <div class="box-body table-responsive no-padding">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Bot</th>
            <th>Type</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $bot->name }}</td>
            <td>{{ $bot->type }}</td>
            <td>{{ $bot->is_enabled == 1 ? 'Enabled' : 'Disabled' }}
          </tr>
        </tbody>
      </table>
    </div>
  </div>

    <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Current Bot Settings</h3>
    </div>
    <div class="box-body table-responsive no-padding">
      <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>BO</th>
                <th>SO</th>
                <th>SOS</th>
                <th>MVC</th>
                <th>MSC</th>
                <th>SOS</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $bot->base_order_volume }} {{$bot->base_order_volume_type }}</td>
            <td>{{ $bot->safety_order_volume }} {{ $bot->safety_order_volume_type }}</td>
            <td>{{ $bot->safety_order_step_percentage }}%</td>
            <td>{{ $bot->martingale_volume_coefficient }}</td>
            <td>{{ $bot->martingale_step_coefficient }}</td>
            <td>{{ $bot->safety_order_step_percentage }}%</td>
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
              <th>Completed USD</th>
              <th>Active USD</th>
              <th>Total USD</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $bot->take_profit }}%</td>
            <td>{{ $bot->take_profit_type }}</td>
            <td>{{ $bot->completed_deals_usd_profit }}</td>
            <td>{{ $bot->active_deals_usd_profit }}</td>
            <td>{{ $bot->total_usd_profit }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@endsection
