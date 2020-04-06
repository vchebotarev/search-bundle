<?php

namespace Chebur\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chebur_search');

        $rootNode
            ->children()
                ->scalarNode('range')->defaultValue(5)->end()
                ->arrayNode('templates')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('pagination')->defaultValue('@CheburSearch/Pagination/simple.html.twig')->end()
                        ->scalarNode('sorting')->defaultValue('@CheburSearch/Sorting/simple.html.twig')->end()
                        ->scalarNode('limitation')->defaultValue('@CheburSearch/Limitation/simple.html.twig')->end()
                    ->end()
                ->end()
                ->arrayNode('services')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('chebur.search.manager.default')->end()
                        ->scalarNode('handler')->defaultValue('chebur.search.request_handler.default')->end()
                        ->scalarNode('options')->defaultValue('chebur.search.options.default')->end()
                    ->end()
                ->end()
                ->arrayNode('param_names')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('page')->defaultValue('page')->end()
                        ->scalarNode('limit')->defaultValue('limit')->end()
                        ->scalarNode('sort')->defaultValue('sort')->end()
                        ->scalarNode('order')->defaultValue('order')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
