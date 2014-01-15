<?php

namespace Qbitz\FreshmailBundle\Tests\Freshmail;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BrowserTest extends WebTestCase {

  public function testConfig() {
    $container = static::createClient()->getContainer();

    $browser = $container->get('qbitz.freshmail');

    $this->assertInstanceOf('\Qbitz\FreshmailBundle\Freshmail\Browser', $browser);
  }

}