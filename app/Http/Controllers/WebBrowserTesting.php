<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
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
      return view('testing_platform');
    }

    public function callSelenium(Request $req)
    {

      $url = $req->input('url');
      $name = $req->input('name');

      $command = $req->input('command');
      $type = $req->input('type');
      $target = $req->input('target');
      $value = $req->input('value');
      $count = $req->input('count');

      $result = false;

      $chkElement = false;

      // //check url exist
      if($this->chkUrl($url)) {
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($this->host, $capabilities, 500);
        $driver->get($url);
        $iteration = 0;

        while($count) {
          // echo '<br>';
          // var_dump($driver);
          // echo '<br>';

          switch ($type[$iteration]) {

            case 'id':
                if($driver->findElement(WebDriverBy::id($target[$iteration]))) {
                  $chkElement = true;
                }
            break;

            case 'class':
                if($driver->findElement(WebDriverBy::id($target[$iteration]))) {
                  $chkElement = true;
                }
            break;

            case 'name':
                if($driver->findElement(WebDriverBy::id($target[$iteration]))) {
                  $chkElement = true;
                }
            break;

            case 'linktext':
                if($driver->findElement(WebDriverBy::linkText($target[$iteration]))) {
                  $chkElement = true;
                }
            break;

          }



          if($chkElement == true) {
            echo 'test';
            switch ($command[$iteration]) {
              case 'click':
                $driver = $driver->findElement(WebDriverBy::linkText($target[$iteration]))->click();
              break;

              case 'sendKeys':
                $driver = $driver->findElement(WebDriverBy::id($target[$iteration]))->sendKeys($value[$iteration])->submit();
              break;

              case 'clear':
                $driver = $driver->findElement(WebDriverBy::id($target[$iteration]))->clear();
              break;
            }

          }

          $count--;
          $iteration++;

        }
      //  $driver->quit();
      }
    //  return back()->withInput();
    }

    public function chkUrl($url)
    {
      $headers = @get_headers($url);
      if(strpos($headers[0],'200')===false)return false;
      return true;
    }
}
