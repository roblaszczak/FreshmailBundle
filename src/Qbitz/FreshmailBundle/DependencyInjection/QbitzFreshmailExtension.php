<?php

namespace Qbitz\FreshmailBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class QbitzFreshmailExtension extends Extension {

  public function load(array $configs, ContainerBuilder $container) {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);


    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    $loader->load('services.yml');

    $container->setParameter('qbitz.freshmail.buzz_client', $config['buzz_client']);
    $container->setParameter('qbitz.freshmail.buzz_timeout', $config['buzz_timeout']);
    $container->setParameter('qbitz.freshmail.api_key', $config['api_key']);
    $container->setParameter('qbitz.freshmail.api_secret', $config['api_secret']);
    $container->setParameter('qbitz.freshmail.host', $config['host']);
    $container->setParameter('qbitz.freshmail.prefix', $config['prefix']);
  }
}
