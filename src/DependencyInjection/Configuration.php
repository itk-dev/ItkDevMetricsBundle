<?php

namespace ItkDev\MetricsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('itkdev_metrics');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('itkdev_metrics');
        }

        $rootNode
            ->children()
                ->scalarNode('namespace')->info('Prefix exported metrics (should be application name)')->defaultValue('ItkDevApp')->end()
                ->arrayNode('adapter')->info('Storage adapter to use')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->enumNode('type')->values(['apcu', 'memory', 'redis'])->defaultValue('inMemory')->end()
                        ->arrayNode('options')->info('Connection options is only used by redis adapter')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('host')->defaultValue('127.0.0.1')->end()
                                ->integerNode('port')->defaultValue(6379)->end()
                                ->scalarNode('password')->end()
                                ->booleanNode('persistent_connections')->defaultValue(false)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
