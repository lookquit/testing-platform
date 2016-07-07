<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use DB;
use App\Http\Requests;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class WebBrowserTesting extends Controller
{
    private $driver;
    private $host = 'http://localhost:4444/wd/hub';
    public function index()
    {
        $name_db = \DB::table('testcases')->select('name_testcase')
                            ->groupBy('name_testcase')
                            ->get();
        $hold;

        foreach ($name_db as $value) {
          $hold['name'][] = \DB::table('testcases')->where('name_testcase', $value->name_testcase)
                                           ->get();
        }

      //  echo '<pre>';
        var_dump($hold);
        //
        // $result = []['sanook'] = [
        //
        // ];

      return view('testing_platform', ['db' => $name_db]);

    }

    public function callSelenium(Request $req) {
      $url = $req->input('url');
      $name = $req->input('name');
      $action = $req->input('command');
      $type = $req->input('type');
      $target = $req->input('target');
      $value = $req->input('value');
      $count = $req->input('count');

      if($this->chkUrl($url)) {
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($this->host, $capabilities, 500);
        $driver->get($url);
        $iteration = 0;

        for ($i=0; $i<$count ; $i++) {
          $chkAction = false;
          $chkElement = false;
          $result = false;
          $log = '';
          $element = '';

          switch ($type[$i]) {

            case 'id':
                if($driver->findElements(WebDriverBy::id($target[$i]))) {
                  $element = $driver->findElement(WebDriverBy::id($target[$i]));
                  $chkElement = true;
                }
            break;

            case 'class':
                if($driver->findElements(WebDriverBy::className($target[$i]))) {
                  $element = $driver->findElement(WebDriverBy::className($target[$i]));
                  $chkElement = true;
                }
            break;

            case 'name':
                if($driver->findElements(WebDriverBy::name($target[$i]))) {
                  $element = $driver->findElement(WebDriverBy::name($target[$i]));
                  $chkElement = true;
                }
            break;

            case 'text':
                if($driver->findElements(WebDriverBy::linkText($target[$i]))) {
                  $element = $driver->findElement(WebDriverBy::linkText($target[$i]));
                  $chkElement = true;
                }
            break;

            default:
              $chkElement = false;
            break;

          }

          if($chkElement == true) {

            switch ($action[$i]) {
              case 'click':
                $element->click();
                $chkAction = true;
              break;

              case 'sendkey':
                $element->sendKeys($value[$i]);
                $chkAction = true;
              break;

              case 'submit':
                $element->submit();
                $chkAction = true;
              break;

              default:
                $chkAction = false;
              break;
            }

          }

          if($chkElement == false || $chkElement == false) {
            $log = 'Failed<br>';
            if($chkElement == false) $log .= '-Failed find element.<br>';
            if($chkAction == false) $log .= '-Failed Action.<br>';
          } else {
            $result = true;
            $log = 'Successful';
          }

          DB::table('testcases')->insert(
            ['name_testcase' => $name, 'url' => $url, 'command' => $action[$i], 'target' => $target[$i], 'value' => $value[$i], 'result' => $result, 'err' => $log]
          );

        }
        $driver->quit();
      } else {
        $result = fasle;
        $log = 'Failed<br>-Failed URL';

        DB::table('testcases')->insert(
          ['name_test_testcase' => $name, 'url' => $url, 'command' => $action, 'target' => $target, 'value' => $value, 'result' => $result, 'err' => $log]
        );
      }

      return back();
    }

    public function chkUrl($url)  {
      $headers = @get_headers($url);
      if(strpos($headers[0],'200')===false) return false;
      return true;
    }
}
