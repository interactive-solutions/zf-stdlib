<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Factory\Mvc\Controller\Plugin;

use InteractiveSolutions\Stdlib\Mvc\Controller\Plugin\ValidateIncomingData;
use Zend\Mvc\Controller\PluginManager;

final class ValidateIncomingDataFactory
{
    public function __invoke(PluginManager $pluginManager)
    {
        return new ValidateIncomingData(
            $pluginManager->getServiceLocator()->get('inputFilterManager')
        );
    }
}
