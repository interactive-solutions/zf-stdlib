<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Factory\Mvc\Controller\Plugin;

use Doctrine\ORM\EntityManager;
use InteractiveSolutions\Stdlib\Mvc\Controller\Plugin\GetEntity;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\PluginManager;

final class GetEntityFactory
{
    /**
     * @param PluginManager $pluginManager
     * @return GetEntity
     */
    public function __invoke(PluginManager $pluginManager): GetEntity
    {
        /* @var ContainerInterface $container */
        $container = $pluginManager->getServiceLocator();

        return new GetEntity($container->get(EntityManager::class));
    }
}
