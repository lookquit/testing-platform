<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;



class WebBrowserTesting extends Controller
{
    public function index()
    {
      return view('testing_platform');
    }

    public function callSelenium()
    {
      echo '<pre>';
      var_dump($_POST);
      // $host = 'http://localhost:4444/wd/hub'; // this is the default
      // $capabilities = DesiredCapabilities::firefox();
      // $driver = RemoteWebDriver::create($host, $capabilities);
      // $driver->get('https://github.com/facebook/php-webdriver');
      // $driver->quit();
    }
}
