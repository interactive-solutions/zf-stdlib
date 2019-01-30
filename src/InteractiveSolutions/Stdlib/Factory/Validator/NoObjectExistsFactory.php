<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

namespace InteractiveSolutions\Stdlib\Factory\Validator;

use Doctrine\Common\Persistence\ObjectManager;
use InteractiveSolutions\Stdlib\Validator\NoObjectExists;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class NoObjectExistsFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return NoObjectExists
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var ObjectManager $objectManager */
        $objectManager = $container->get('InteractiveSolutions\Stdlib\ObjectManager');

        return new NoObjectExists(
            array_merge(
                ['object_repository' => $objectManager->getRepository($options['entity_class'])],
                $options
            )
        );
    }
}
