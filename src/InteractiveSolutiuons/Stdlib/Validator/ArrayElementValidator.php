<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Validator;

use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class ArrayElementValidator extends AbstractValidator
{
    const ERROR_NOT_ALL_VALID = 'is:stdlib:not-all-valid';
    const ERROR_NOT_ARRAY     = 'is:stdlib:not-array';
    const ERROR_EMPTY_ARRAY   = 'is:stdlib:empty-array';

    protected $messageTemplates = [
        self::ERROR_NOT_ALL_VALID => 'All elements are not valid',
        self::ERROR_NOT_ARRAY     => 'Value is not an array',
        self::ERROR_EMPTY_ARRAY   => 'Provided array is empty'
    ];

    /**
     * @var AbstractValidator
     */
    private $elementValidator;

    public function __construct(array $options)
    {
        $this->elementValidator = $options['validator'];

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($value)
    {
        if (!is_array($value)) {
            $this->error(static::ERROR_NOT_ARRAY);

            return false;
        }

        foreach ($value as $element) {
            if (!$this->elementValidator->isValid($element)) {
                $this->error(static::ERROR_NOT_ALL_VALID);

                return false;
            }
        }

        return true;
    }
}
