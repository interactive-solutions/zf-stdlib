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
use ZfcRbac\Service\AuthorizationService;

final class GetEntityFactory
{
    /**
     * @param ContainerInterface $container
     * @return GetEntity
     *
     */
    public function __invoke(ContainerInterface $container): GetEntity
    {
        return new GetEntity(
            $container->get(EntityManager::class),
            $container->get(AuthorizationService::class)
        );
    }
}
