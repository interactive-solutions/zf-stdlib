<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Factory\Mvc\Controller\Plugin;

use InteractiveSolutions\Stdlib\Mvc\Controller\Plugin\ValidateIncomingData;
use Psr\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\Mvc\Controller\PluginManager;

final class ValidateIncomingDataFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ValidateIncomingData(
            $container->get(InputFilterPluginManager::class)
        );
    }
}
