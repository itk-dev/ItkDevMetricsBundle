<?php

namespace ItkDev\MetricsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ItkDevMetricsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('itk_dev_metrics.service.metrics_service');
        $definition->setArgument(0, $config['namespace']);
        $definition->setArgument(1, $config['adapter']['type']);
        $definition->setArgument(2, $config['adapter']['options']);
    }

    public function getAlias(): string
    {
        return 'itkdev_metrics';
    }
}
