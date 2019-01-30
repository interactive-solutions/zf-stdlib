<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types=1);

namespace InteractiveSolutions\Stdlib\Factory\Validator;

use InteractiveSolutions\Stdlib\Validator\ArrayElementValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ArrayElementValidatorFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return ArrayElementValidator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $keyValidator   = $options['keyValidatorClass'] ?? null;
        $keyOptions = $options['keyValidatorOptions'] ?? [];

        $valueValidator = $options['valueValidatorClass'] ?? $options['validatorClass'] ?? null;
        $valueOptions = $options['valueValidatorOptions'] ?? [];

        $keyValidator   = $keyValidator !== null ? $container->get($keyValidator, $keyOptions) : null;
        $valueValidator = $valueValidator !== null ? $container->get($valueValidator, $valueOptions) : null;

        return new ArrayElementValidator(
            array_merge(
                [
                    'keyValidator'   => $keyValidator,
                    'valueValidator' => $valueValidator,
                ],
                $options
            )
        );
    }
}
