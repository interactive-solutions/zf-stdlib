<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

namespace InteractiveSolutions\Stdlib\Factory\Validator;

use Doctrine\Common\Persistence\ObjectManager;
use InteractiveSolutions\Stdlib\Validator\NoObjectExists;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\ValidatorPluginManager;

class NoObjectExistsFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * Set creation options
     *
     * @param  array $options
     * @return void
     */
    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface|ValidatorPluginManager $validatorManager
     * @return NoObjectExists
     */
    public function createService(ServiceLocatorInterface $validatorManager)
    {
        $sl = $validatorManager->getServiceLocator();

        /* @var ObjectManager $objectManager */
        $objectManager = $sl->get('InteractiveSolutions\Stdlib\ObjectManager');

        return new NoObjectExists(
            array_merge(
                ['object_repository' => $objectManager->getRepository($this->options['entity_class'])],
                $this->options
            )
        );
    }
}
