@extends('layout') @section('content')
<!-- <pre>
  {{var_dump($db)}} -->
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default clearfix ">
            <div class="panel-heading style-tx">Testing</div>
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
                            <td>action</td>
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
                                    <select name="type[]" class="form-control">
                                      <option value="id">Id</option>
                                      <option value="class">Class</option>
                                      <option value="name">Name</option>
                                      <option value="text">Text</option>
                                    </select>
                                    <input type="text" name="target[]" value="" placeholder="Target" class="form-control">
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
            </form>

            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading style-tx">History</div>

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      TEST CASE #
                    </a>
                  </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            Situation admitting promotion at or to perceived be. Mr acuteness we as estimable enjoyment up. An held late as felt know. Learn do allow solid to grave. Middleton suspicion age her attention. Chiefly several bed its wishing. Is so moments on chamber
                            pressed to. Doubtful yet way properly answered humanity its desirous. Minuter believe service arrived civilly add all. Acuteness allowance an at eagerness favourite in extensive exquisite ye.
                        </div>
                    </div>
                </div>
            </div>

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
            '<td><select name="type[]" class="form-control"><option value="id">Id</option><option value="class">Class</option><option value="name">Name</option><option value="text">Text</option></select><input type="text" name="target[]" value="" placeholder="Target" class="form-control"></td>' +
            '<td><input type="text" name="value[]" value="" placeholder="Value" class="form-control"></td>'+
            '<td><button class="btn btn-default" id="show" type="button" onClick="addInput(\'form-dynamic\');">+</button></td>';
        document.getElementById("submit").value = count+1;
        document.getElementById(form).appendChild(newdiv);
        count++;
    }
</script>
@endsection
