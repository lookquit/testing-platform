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

  public function index($browser = "firefox")
  {
    $ff = "";
    $ie = "";
    $chrome = "";
    if($browser == "firefox") {
      $ff = "icon-ff";
    }
    if($browser == "ie") {
      $ie = "icon-ie";
    }
    if($browser == "chrome") {
      $chrome = "icon-chrome";
    }

    $hold;
    $name_db = \DB::table('testcases')->select('name_testcase')
                ->groupBy('name_testcase')
                ->get();
    foreach ($name_db as $value)
    {
      $hold[] = \DB::table('testcases')->where('name_testcase', $value->name_testcase)
                                       ->get();
    }
    return view('testing_platform', ['db' => $hold, 'ff' => $ff, 'ie' => $ie, 'chrome' => $chrome, 'browser' => $browser]);
  }

  public function chkUrl($url)
  {
    $headers = @get_headers($url);
    if(strpos($headers[0],'200')===false) return false;
    return true;
  }

  public function callSelenium(Request $req)
  {
    $url = $req->input('url');
    $name = $req->input('name');
    $action = $req->input('command');
    $type = $req->input('type');
    $target = $req->input('target');
    $value = $req->input('value');
    $count = $req->input('count');
    $browser = $req->input('browser');

    $result = 0;
    $capabilities = null;
    if($this->chkUrl($url))
    {
      if($browser == 'firefox') $capabilities = DesiredCapabilities::firefox();
      if($browser == 'chrome') $capabilities = DesiredCapabilities::chrome();
      if($browser == 'ie') $capabilities = DesiredCapabilities::internetexplorer();
      //$capabilities = DesiredCapabilities::firefox();
      $driver = RemoteWebDriver::create($this->host, $capabilities);
      $driver->get($url);
      $result++;

      for ($i=0; $i<$count ; $i++)
      {
        $result = 1;
        $element = '';
        switch ($type[$i]) {

          case 'id':
              if($driver->findElements(WebDriverBy::id($target[$i]))) {
                $element = $driver->findElement(WebDriverBy::id($target[$i]));
                $result++;
              }
          break;

          case 'class':
              if($driver->findElements(WebDriverBy::className($target[$i]))) {
                $element = $driver->findElement(WebDriverBy::className($target[$i]));
                $result++;
              }
          break;

          case 'name':
              if($driver->findElements(WebDriverBy::name($target[$i]))) {
                $element = $driver->findElement(WebDriverBy::name($target[$i]));
                $result++;
              }
          break;

          case 'text':
              if($driver->findElements(WebDriverBy::linkText($target[$i]))) {
                $element = $driver->findElement(WebDriverBy::linkText($target[$i]));
                $result++;
              }
          break;

          default:

          break;

        }

        if($result == 2) {

          switch ($action[$i]) {
            case 'click':
              $element->click();
              $result++;
            break;

            case 'sendkey':
              $element->sendKeys($value[$i]);
              $result++;
            break;

            case 'submit':
              $element->submit();
              $result++;
            break;

            default:

            break;
          }

        }

        DB::table('testcases')->insert(
          ['name_testcase' => $name, 'url' => $url, 'command' => $action[$i], 'target' => $target[$i], 'value' => $value[$i], 'result' => $result, 'err' => '']
        );

      }

      $driver->quit();

    } else {
      DB::table('testcases')->insert(
        ['name_test_testcase' => $name, 'url' => $url, 'command' => $action[0], 'target' => $target, 'value' => $value, 'result' => $result, 'err' => '']
      );

    }
    return back();
  }

  public function test()
  {

  }

  public function page1()
  {
    $screenshot = 'C:\xampp\htdocs\testing-platform\public\img\\' . time() . ".png";
    $capabilities = DesiredCapabilities::internetexplorer();
    $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities, 500);
    $driver->get('https://www.blognone.com/');
    $driver->takeScreenshot($screenshot);
    // $driver->findElement(WebDriverBy::linkText("รีวิว Pokemon Go ออกเดินทางไปจับโปเกมอนกันเถอะ!"))->click();
    // //$driver->quit();
    // echo '<h1>HA HA HA HA</h1>';
    return view('test');
  }

  public function page2()
  {
    echo 'h1';
  }

  public function page3()
  {
    echo 'a tag';
  }



}
