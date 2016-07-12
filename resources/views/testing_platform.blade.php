@extends('layout') @section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default clearfix ">
            <div class="panel-heading style-tx">Testing</div>
            <a href="/firefox"><i class="fa fa-firefox fa-5x {{ $ff }}" aria-hidden="true"  atl="Firefox" title="Firefox"></i></a>
            <a href="/chrome"><i class="fa fa-chrome fa-5x {{ $chrome }}" aria-hidden="true" atl="Chrome" title="Chrome"></i></a>
            <a href="/ie"><i class="fa fa-internet-explorer fa-5x {{ $ie }}" aria-hidden="true" atl="Internet Explorer" title="Internet Explorer"></i></a>

            <form method="POST" action="{{ route('test') }}" class="form-horizontal" role="form">
                <div class="form-cl">

                    <div class="form-group">
                        <label for="url">Base URL:</label>
                        <input type="text" name="url" class="form-control" id="url" placeholder="URL">
                    </div>

                    <div class="form-group">
                        <label for="name">Test Case Name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    </div>

                    <table class="table head-table text-center">
                        <tr>
                            <td>Test Steps</td>
                            <td>Action</td>
                            <td>Type</td>
                            <td>Target</td>
                            <td>Value</td>
                            <td></td>
                        </tr>
                        <tbody id="form-dynamic">
                            <tr>
                                <td>1</td>
                                <td>
                                  <select name="command[]" class="form-control">
                                    <option value="click">Click</option>
                                    <option value="sendkey">SendKeys</option>
                                    <option value="submit">Submit</option>
                                    <option value="verify">Verify</option>
                                  </select>
                                </td>
                                <td>

                                    <select name="type[]" class="form-control type-cus">
                                      <option value="id">Id</option>
                                      <option value="class">Class</option>
                                      <option value="name">Name</option>
                                      <option value="text">Text</option>
                                    </select>


                                </td>
                                <td>
                                          <input type="text" name="target[]" value="" placeholder="Target" class="form-control target-cus">
                                </td>
                                <td>
                                    <input type="text" name="value[]" value="" placeholder="Value" class="form-control">
                                </td>
                                <td>
                                    <button class="btn btn-default" type="button" id="show" onClick="addInput('form-dynamic');">+</button>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                    <button class="btn btn-lg btn-success pull-right bth-style" id="submit" type="submit" name="count" value="1">Run</button>
                    {{ csrf_field() }}
                    <input type="hidden" name="browser" value="{{ $browser }}">
            </form>

            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading style-tx">History</div>
            @foreach( $db as $put => $name )
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$put+1}}">
                        <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$put+1}}" aria-expanded="true" aria-controls="collapse{{$put+1}}">
                      TestCase{{$put+1}}: {{$name[0]->name_testcase}}
                    </a>
                  </h4>
                    </div>
                    <div id="collapse{{$put+1}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$put+1}}">
                        <div class="panel-body">
                          @foreach( $name as $key => $value )
                            @if($value->result == 0)
                              <li class="fail"><span class="glyphicon glyphicon-remove icon-space"></span> Failed: Not Found URL</li><br>
                            @endif
                            @if($value->result == 1)
                              <li class="fail"><span class="glyphicon glyphicon-remove icon-space"></span> Failed: {{$value->target}} : Not Found Element</li><br>
                            @endif
                            @if($value->result == 2)
                              <li class="fail"><span class="glyphicon glyphicon-remove icon-space"></span>Failed: {{$value->command}} {{$value->target}} : Cannot Command</li><br>
                            @endif
                            @if($value->result == 3)
                              <li class="success"><span class="glyphicon glyphicon-ok icon-space"></span>Success: {{$value->command}} {{$value->target}}</li><br>
                            @endif
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection @section('script')
<script type="text/javascript">
    var count = 1;

    function addInput(form) {
        document.getElementById("show").id = "none";
        var newdiv = document.createElement('tr');
        newdiv.innerHTML =
            '<td>' + (count + 1) + '</td>' +
            '<td><select name="command[]" class="form-control"><option value="click">Click</option><option value="sendkey">SendKeys</option><option value="submit">Submit</option><option value="verify">Verify</option></select></td>'+
            '<td><select name="type[]" class="form-control type-cus"><option value="id">Id</option><option value="class">Class</option><option value="name">Name</option><option value="text">Text</option></select></td><td><input type="text" name="target[]" value="" placeholder="Target" class="form-control target-cus"></td>' +
            '<td><input type="text" name="value[]" value="" placeholder="Value" class="form-control"></td>'+
            '<td><button class="btn btn-default" id="show" type="button" onClick="addInput(\'form-dynamic\');">+</button></td>';
        document.getElementById("submit").value = count+1;
        document.getElementById(form).appendChild(newdiv);
        count++;
    }
</script>
@endsection
