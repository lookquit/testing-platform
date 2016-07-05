@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default clearfix ">
            <div class="panel-heading style-tx">Testing</div>
            <div class="form-cl">

                <div class="form-group">
                    <label for="exampleInputName2">Base URL:</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="URL">
                </div>

                <div class="form-group">
                    <label for="exampleInputName2">Test Case Name:</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Name">
                </div>
                <form method="POST" class="form-horizontal" role="form">
                    <table class="table head-table text-center" >
                        <tr>
                            <td>Test Steps</td>
                            <td>Command</td>
                            <td>Target</td>
                            <td>Value</td>
                            <td></td>
                        </tr>
                        <tbody id="form-dynamic">
                          <tr>
                              <td>1</td>
                              <td>
                                  <input type="text" name="tc[]" value="" placeholder="Command" class="form-control">
                              </td>
                              <td>
                                  <input type="text" name="tc[]" value="" placeholder="Target" class="form-control">
                              </td>
                              <td>
                                  <input type="text" name="tc[]" value="" placeholder="Value" class="form-control">
                              </td>
                              <td>
                                  <button class="btn btn-default" type="button" onClick="addInput('form-dynamic');">+</button>
                              </td>
                          </tr>
                        </tbody>

                    </table>
                    {{ csrf_field() }}
                </form>
                <button class="btn btn-lg btn-success pull-right bth-style" type="submit">Run</button>
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
                      Collapsible Group Item #1
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Collapsible Group Item #2
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Collapsible Group Item #3
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
        var newdiv = document.createElement('tr');
        newdiv.innerHTML =
            '<td>' + (count + 1) + '</td>' +
            '<td><input type="text" name="name" value="" placeholder="Command" class="form-control"></td>' +
            '<td><input type="text" name="name" value="" placeholder="Target" class="form-control"></td>' +
            '<td><input type="text" name="name" value="" placeholder="Value" class="form-control"></td>' +
            '<td><button class="btn btn-default" type="button" onClick="addInput(\'form-dynamic\');">+</button></td>';
        document.getElementById(form).appendChild(newdiv);
        count++;
    }
</script>
@endsection
