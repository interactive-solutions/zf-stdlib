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
use Zend\Validator\ValidatorPluginManager;

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

        /** @var ValidatorPluginManager $validatorPluginManager */
        $validatorPluginManager = $container->get(ValidatorPluginManager::class);

        $keyValidator   = $keyValidator !== null ? $validatorPluginManager->get($keyValidator, $keyOptions) : null;
        $valueValidator = $valueValidator !== null ? $validatorPluginManager->get($valueValidator, $valueOptions) : null;

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
