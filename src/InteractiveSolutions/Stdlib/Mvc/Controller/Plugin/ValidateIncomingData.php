<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Mvc\Controller\Plugin;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use ZfrRest\Http\Exception\Client\UnprocessableEntityException;

/**
 * @author  Michaël Gallego <mic.gallego@gmail.com>
 * @licence MIT
 */
class ValidateIncomingData extends AbstractPlugin
{
    /**
     * @var InputFilterPluginManager
     */
    private $inputFilterPluginManager;

    /**
     * @param InputFilterPluginManager $inputFilterPluginManager
     */
    public function __construct(InputFilterPluginManager $inputFilterPluginManager)
    {
        $this->inputFilterPluginManager = $inputFilterPluginManager;
    }

    /**
     * Get the input filter, and validate the incoming data
     *
     * @TODO: when we have the new input filter, we should use named validation group and context
     *
     * @param  string $inputFilterName
     * @param  array  $validationGroup
     * @param  mixed  $context
     * @return array
     * @throws UnprocessableEntityException
     */
    public function __invoke($inputFilterName, array $validationGroup = [], $context = null)
    {
        /** @var \Zend\InputFilter\InputFilterInterface $inputFilter */
        $inputFilter = $this->inputFilterPluginManager->get($inputFilterName);

        if (!empty($validationGroup)) {
            $inputFilter->setValidationGroup($validationGroup);
        }

        $data = array_merge(
            json_decode($this->controller->getRequest()->getContent(), true) ?: [],
            $this->controller->getRequest()->getPost()->toArray()
        );
        $inputFilter->setData($data);

        if ($inputFilter->isValid($context)) {
            return $inputFilter->getValues();
        }

        throw new UnprocessableEntityException('Validation error', $inputFilter->getMessages());
    }
}

