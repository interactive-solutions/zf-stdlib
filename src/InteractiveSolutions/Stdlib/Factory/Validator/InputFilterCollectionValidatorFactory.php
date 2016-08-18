<?php
/**
 * @author    Jonas Eriksson <jonas.eriksson@interactivesolutions.se>
 *
 * @copyright Interactive Solutions
 */
declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Factory\Validator;

use InteractiveSolutions\Stdlib\Validator\InputFilterCollectionValidator;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\ValidatorPluginManager;

final class InputFilterCollectionValidatorFactory implements FactoryInterface, MutableCreationOptionsInterface
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
     * @return InputFilterCollectionValidator
     */
    public function createService(ServiceLocatorInterface $validatorManager)
    {
        /* @var InputFilterPluginManager $inputFilterManager */
        $inputFilterManager = $validatorManager->getServiceLocator()->get('InputFilterManager');

        return new InputFilterCollectionValidator(
            array_merge(
                ['inputFilter' => $inputFilterManager->get($this->options['inputFilterClass'])],
                $this->options
            )
        );
    }
}
