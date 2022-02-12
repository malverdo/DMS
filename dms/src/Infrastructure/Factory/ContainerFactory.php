<?php

namespace App\Infrastructure\Factory;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Class ContainerFactory
 * @package App\Infrastructure\Factory
 */
final class ContainerFactory
{

    /**
     * @return ContainerBuilder
     */
    public static function build(): ContainerBuilder
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator($_SERVER['DOCUMENT_ROOT'] . '/../config'));
        $loader->load('services.yaml');
        return $container;
    }
}