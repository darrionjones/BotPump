@extends('layouts.default')

@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">APIs</h3>
    @if ($api_keys->isEmpty())
      <a href="{{ url('/apikey/create') }}" class="btn btn-sm btn-flat btn-success pull-right">Trading Bot API Key</a>
    @else
      <a disabled href="{{ url('/apikey/create') }}" class="btn btn-sm btn-flat btn-success pull-right">Trading Bot API Key</a>
    @endif
  </div>
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>API Name</th>
          <th>API Type</th>
          <th>API Key</th>
          <th>Deal Count</th>
        </tr>
      </thead>
      <tbody>
        @foreach($api_keys as $api_key)
          <tr>
            <td>{{ $api_key['name'] }}</td>
            <td>3commas.io</td>
            <td>{{ $api_key['api_key'] }}</td>
            <td>{{ $api_key['deal_count'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection