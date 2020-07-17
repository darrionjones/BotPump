@extends('layouts.default')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Bot Service API</h3>
    </div>
    <form role="form" action="{{ route('apikey/store') }}" method="post">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">API Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter API Name" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('api_type') ? 'has-error' : '' }}">
                    <label for="api_key">API Type</label>
                    <select type="text" class="form-control" id="api_type" name="api_type" placeholder="Select API Type" required>
                        <option value="" disabled selected hidden>API Site</option>
                        <option value="3commas.io>">3commas.io</option>
                    </select>
                    @if ($errors->has('api_type'))
                        <div style="color: red;">{{ $errors->first('api_type') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
            <div class="form-group {{ $errors->has('api_key') ? 'has-error' : '' }}">
                <label for="api_key">API Key</label>
                <input type="text" class="form-control" id="api_key" name="api_key" placeholder="Enter API Key" required>
                @if ($errors->has('api_key'))
                    <div style="color: red;">{{ $errors->first('api_key') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('secret_key') ? 'has-error' : '' }}">
                <label for="secret_key">Secret Key</label>
                <input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="Enter Secret Key" required>
                @if ($errors->has('secret_key'))
                    <div style="color: red;">{{ $errors->first('secret_key') }}</div>
                @endif
            </div>
        </div>
    </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create API</button>
        </div>
    </form>

    <div class="overlay" style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('form').submit(function () {
            $('.overlay').show();
        });
    </script>
@endsection