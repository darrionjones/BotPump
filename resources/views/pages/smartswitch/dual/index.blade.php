@extends('layouts.default')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Dual Bot SmartSwitch</h3>
        <a  href="/smartswitch/dual/create" class="btn btn-sm btn-flat btn-success pull-right">Create New</a>
    </div>

    <div class="box-body">
        What is Dual Bot SmartSwitch? This will allow you to select two bots, one long and the other short and control them via two TradingView alerts. As an example, a TradingView alert could start a long bot. When your indicators indicate it's time to go short, the short bot can be triggered. This feature allows you to take full advantage of all the options that are available. When the switch occurs you can choose to stop the long bot and let it finish the open deal. And of course you can panic sell the position. The same would go for the short bot and the process can go back and forth. Instead of simply starting a new deal, the option to start the bot is available. Checkout your options below.
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create a dual bot</h3>
    </div>

    <div class="box-body table-responsive no-padding">
        <form id="myform" name="myform">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Long Bot</th>
            <th>Short Bot</th>
            <th>Action</th>
            <th>Current Deal Strategy</th>
            <th>Enabled?</th>
            <th>Active?</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($all_duals as $dual)
            <tr>
            <td><input type="checkbox"></td>
            <td><a href="/smartswitch/dual/{{ $dual->id }}">{{ $dual->name }}</a></td>
            <td>{{ $dual->long_bot->name }}</td>
            <td>{{ $dual->short_bot->name }}</td>
            <td>{{ $dual->switch_action }}</td>
            <td>{{ $dual->active_deal_strategy }}</td>
            <td>
{{ $dual->is_enabled }}
<label class="switch">
  <input type="checkbox" class="is_enabled" id="is_enabled" name="is_enabled" value="Submit" checked>
  <span class="slider round"></span>
</label></span>

            </td>
            <td>
                @if ($dual->is_active == 0)
                    NO
                @else
                    YES
                @endif
            </td>
            </tr>
            @endforeach
        </tbody>
      </table>
  </form>
    </div>
</div>
@endsection

@section('script')
<script>
    send_data = function(name) {

        $.ajax({
      url: "/test/index.php",
            dataType: "json",
            data: {'name' : name},
            type: "POST",
            cache: false

    }).done(function(data, status, xml) {

         var obj = jQuery.parseJSON(data);
         alert(obj.success);

        }).fail(function(jqXHR, textStatus, errorThrown) {
console.log("fail");

        }).always(function() {
console.log("This is the ajax attempt");

        });

}

$(document).ready(function() {
console.log("ready!");
    $("#myform").submit(function() {

        //var cb = $("input#is_enabled");

        var cb = $('.is_enabled:checked').val();

        if (cb.is(":checked")) {
            send_data(cb.val());
            console.log("is_enabled = 0 change to 1");
        } else {
            send_data(cb.val());
            console.log("is_enabled = 1 change to 0");
        }
        return false;
    });

});

$(document).ready(function(){
    $("#myform").on("change", "input:checkbox", function(){
        $("#myform").submit();
    });
});

</script>
@endsection
