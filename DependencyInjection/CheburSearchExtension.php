<?php

namespace Chebur\SearchBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class CheburSearchExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->processServices($config['services'], $container);
        $this->processDefaultOptions($config, $container);
    }

    /**
     * @param array            $configServices
     * @param ContainerBuilder $containerBuilder
     */
    protected function processServices(array $configServices, ContainerBuilder $containerBuilder)
    {
        $containerBuilder->setAlias('chebur.search.request_handler', $configServices['handler']);

        $containerBuilder->setAlias('chebur.search.options', $configServices['options']);

        $containerBuilder->setAlias('chebur.search.manager', $configServices['manager']);
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $containerBuilder
     */
    protected function processDefaultOptions(array $config, ContainerBuilder $containerBuilder)
    {
        $optionsDefenition = $containerBuilder->getDefinition($containerBuilder->getAlias('chebur.search.options'));
        $optionsDefenition->addMethodCall('setPageRange', [$config['range']]);
        //templates
        $optionsDefenition->addMethodCall('setTemplateLimitation', [$config['templates']['limitation']]);
        $optionsDefenition->addMethodCall('setTemplatePagination', [$config['templates']['pagination']]);
        $optionsDefenition->addMethodCall('setTemplateSorting', [$config['templates']['sorting']]);
        //param names
        $optionsDefenition->addMethodCall('setParamNamePage', [$config['param_names']['page']]);
        $optionsDefenition->addMethodCall('setParamNameLimit', [$config['param_names']['limit']]);
        $optionsDefenition->addMethodCall('setParamNameSort', [$config['param_names']['sort']]);
        $optionsDefenition->addMethodCall('setParamNameOrder', [$config['param_names']['order']]);
    }

}
