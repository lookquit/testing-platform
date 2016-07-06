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

      // //check url exist !!!!!!!!!!!
      $capabilities = DesiredCapabilities::firefox();
      $driver = RemoteWebDriver::create($this->host, $capabilities, 500);
      $driver->get('https://facebook.github.io/react/docs/getting-started.html');

      for ($i=0; $i < 5; $i++) {

        $driver->findElement(WebDriverBy::linkText('Interactivity and Dynamic UIs'))->click();
        $driver->findElement(WebDriverBy::linkText('Multiple Components'))->click();
      }



      // 22222222222222
      // $link = array(
      //                 'commad' => array('click', 'link', 'Docs'),
      //                 'type'   => array('click', 'class', '/react/docs/why-react.html'),
      //                 'target' => array('click', 'class', '/react/docs/working-with-the-browser.html')
      // );
      //
      //
      // foreach ($link as $value) {
      //   if($value[1] == 'link') {
      //     $driver->findElement(WebDriverBy::linkText($value[2]))->click();
      //   }
      //   if($value[1] == 'class') {
      //     $driver->findElement(WebDriverBy::cssSelector("a[href*='$value[2]']"))->click();
      //   }
      // }

      //11111111111111111
      //$link = array('Multiple Components', 'Why React?', 'Multiple Components');



      // foreach ($link as  $value) {
      //   $driver->findElement(WebDriverBy::linkText($value))->click();
      // }

      // $driver->findElement(WebDriverBy::linkText('Multiple Components'))->click();
      // $driver->findElement(WebDriverBy::linkText('Why React?'))->click();
      // $driver->findElement(WebDriverBy::linkText('Multiple Components'))->click();


    //  return back()->withInput();
    }

    public function chkUrl($url)  {
      $headers = @get_headers($url);
      if(strpos($headers[0],'200')===false) return false;
      return true;
    }


}
