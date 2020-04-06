<?php

namespace Chebur\SearchBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class CheburSearchExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->processServices($config['services'], $container);
        $this->processDefaultOptions($config, $container);
    }

    protected function processServices(array $configServices, ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->setAlias('chebur.search.request_handler', $configServices['handler']);

        $containerBuilder->setAlias('chebur.search.options', $configServices['options']);

        $containerBuilder->setAlias('chebur.search.manager', $configServices['manager']);
    }

    protected function processDefaultOptions(array $config, ContainerBuilder $containerBuilder): void
    {
        $optionsDefinition = $containerBuilder->getDefinition($containerBuilder->getAlias('chebur.search.options'));
        $optionsDefinition->addMethodCall('setPageRange', [$config['range']]);
        //templates
        $optionsDefinition->addMethodCall('setTemplateLimitation', [$config['templates']['limitation']]);
        $optionsDefinition->addMethodCall('setTemplatePagination', [$config['templates']['pagination']]);
        $optionsDefinition->addMethodCall('setTemplateSorting', [$config['templates']['sorting']]);
        //param names
        $optionsDefinition->addMethodCall('setParamNamePage', [$config['param_names']['page']]);
        $optionsDefinition->addMethodCall('setParamNameLimit', [$config['param_names']['limit']]);
        $optionsDefinition->addMethodCall('setParamNameSort', [$config['param_names']['sort']]);
        $optionsDefinition->addMethodCall('setParamNameOrder', [$config['param_names']['order']]);
    }
}
