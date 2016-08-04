<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Factory\Validator;

use InteractiveSolutions\Stdlib\Validator\ArrayElementValidator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\ValidatorPluginManager;

class ArrayElementValidatorFactory implements FactoryInterface, MutableCreationOptionsInterface
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
     * @return ArrayElementValidator
     */
    public function createService(ServiceLocatorInterface $validatorManager)
    {
        return new ArrayElementValidator(
            array_merge(
                ['validator' => $validatorManager->get($this->options['validatorClass'])],
                $this->options
            )
        );
    }
}
