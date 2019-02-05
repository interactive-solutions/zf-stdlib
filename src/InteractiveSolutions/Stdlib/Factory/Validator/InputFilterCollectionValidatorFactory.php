<?php
/**
 * @author    Jonas Eriksson <jonas.eriksson@interactivesolutions.se>
 *
 * @copyright Interactive Solutions
 */
declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Factory\Validator;

use InteractiveSolutions\Stdlib\Validator\InputFilterCollectionValidator;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

final class InputFilterCollectionValidatorFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return InputFilterCollectionValidator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var InputFilterPluginManager $inputFilterManager */
        $inputFilterManager = $container->get('InputFilterManager');

        return new InputFilterCollectionValidator(
            array_merge(
                ['inputFilter' => $inputFilterManager->get($options['inputFilterClass'])],
                $options
            )
        );
    }
}
