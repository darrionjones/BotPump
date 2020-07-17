@extends('layouts.default')

@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Exchange Key APIs</h3>
    <a disabled href="#" class="btn btn-sm btn-flat btn-success pull-right">New API Key</a>
  </div>
  <div class="box-body table-responsive no-padding">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>API Name</th>
                <th>API Type</th>
                <th>API Key</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exchange_keys as $exchange_key)
                <tr>
                    <td>{{ $exchange_key['name'] }}</td>
                    <td>Binance</td>
                    <td>{{ $exchange_key['api_key'] }}</td>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection