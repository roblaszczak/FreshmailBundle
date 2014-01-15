<?php

namespace Qbitz\FreshmailBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('qbitz_freshmail');

    $rootNode
      ->children()
        ->enumNode('buzz_client')
          ->values(array('curl', 'file_get_contents'))
          ->defaultValue('curl')
        ->end()
        ->integerNode('buzz_timeout')
            ->min(1)->max(60)
            ->defaultValue(5)
        ->end()
        ->scalarNode('api_key')
          ->isRequired()
          ->defaultNull()
        ->end()
        ->scalarNode('api_secret')
          ->isRequired()
          ->defaultNull()
        ->end()
        ->scalarNode('host')->defaultValue('https://app.freshmail.pl/')->end()
        ->scalarNode('prefix')->defaultValue('rest/')->end()
      ->end();

    return $treeBuilder;
  }
}
