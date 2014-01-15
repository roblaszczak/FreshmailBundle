<?php

namespace Qbitz\FreshmailBundle\Buzz;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Client\FileGetContents;

class BrowserFactory {

  public function getBrowser($_client, $_timeout) {

    switch($_client) {
      case 'curl':
        $client = new Curl();
        break;
      case 'file_get_contents':
        $client = new FileGetContents();
        break;
      default:
        throw new \Exception('Client type "'.$_client.'" is invalid');
    }
    $client->setTimeout($_timeout);

    return new Browser($client);
  }

}
