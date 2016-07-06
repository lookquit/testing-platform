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
