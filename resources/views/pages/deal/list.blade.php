@extends('layouts.default')

@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Active Deals</h3>
  </div>
  <div class="box-body table-responsive no-padding">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Bot</th>
        <th colspan="2">Pair</th>
        <th>Started</th>
      </tr>
    </thead>
    <tbody>
      @foreach($active_deals_list as $active)
        <tr>
          <td><a href="{{ route('basic.deal.show', $active->id ) }}" class="label label-primary" title="Show Deal">{{ $active->id }}</a></td>
          <td><a href="{{ route('basic.bot.show', $active->bot_id ) }}" class="label label-primary" title="Show Bot">{{ $active->bot_name }}</a></td>
          <td><span style="float: right;"><span class="label bg-gray">{{ $active->from_currency }}</span><img src="{{ asset('img/coins/' . strtolower($active->from_currency) . '.png') }}" height="22px"></span></td>
          <td><img src="{{ asset('img/coins/' . strtolower($active->to_currency) . '.png') }}" height="22px"><span class="label bg-gray">{{ $active->to_currency }}</span></td>
          <td>{{ $active->created_at }}</td>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

<div class="box box-success">
  <div class="box-header">
  <h3 class="box-title">All Deals</h3>
  </div>
  <div class="box-body table-responsive no-padding">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID/Bot</th>
        <th colspan="2">Pair</th>
        <th>Status</th>
        <th>Profit</th>
        <th>Profit</th>
        <th>Closed</th>
      </tr>
    </thead>
    <tbody>
      @foreach($all_completed_deals as $completed)
        <tr>
          <td>
            <a href="{{ route('basic.deal.show', $completed->id ) }}" class="label bg-gray" title="Show Deal">ID: {{ $completed->id }}</a><br>
            <a href="{{ route('basic.bot.show', $active->bot_id ) }}" class="label bg-gray" title="Show Bot">{{ $active->bot_name }}</a>
          </td>
          <td><span style="float: right;"><span class="label bg-gray">{{ $completed->from_currency }}</span><img src="{{ asset('img/coins/' . strtolower($completed->from_currency) . '.png') }}" height="22px"></span></td>
          <td><img src="{{ asset('img/coins/' . strtolower($completed->to_currency) . '.png') }}" height="22px"><span class="label bg-gray">{{ $completed->to_currency }}</span></td>
          <td>{{ $completed->status }}</td>
          <td>{{ $completed->final_profit }}</td>
          <td>${{ $completed->usd_final_profit }}</td>
          <td>{{ $completed->closed_at }}</td>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection
