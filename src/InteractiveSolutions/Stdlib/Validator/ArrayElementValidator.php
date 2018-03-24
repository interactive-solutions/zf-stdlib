<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types=1);

namespace InteractiveSolutions\Stdlib\Validator;

use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;
use Zend\Validator\ValidatorInterface;

class ArrayElementValidator extends AbstractValidator
{
    const ERROR_NOT_ALL_VALID = 'is:stdlib:not-all-valid';
    const ERROR_NOT_ARRAY = 'is:stdlib:not-array';
    const ERROR_EMPTY_ARRAY = 'is:stdlib:empty-array';

    const VALIDATE_KEY = 'key';
    const VALIDATE_VALUE = 'value';
    const VALIDATE_BOTH = 'both';

    /**
     * @var string
     */
    protected $validationMode = self::VALIDATE_VALUE;

    /**
     * @var array
     */
    protected $messageTemplates = [
        self::ERROR_NOT_ALL_VALID => 'The value %value% is not valid',
        self::ERROR_NOT_ARRAY     => 'Value is not an array',
        self::ERROR_EMPTY_ARRAY   => 'Provided array is empty',
    ];

    /**
     * @var ValidatorInterface|null
     */
    private $valueValidator;

    /**
     * @var ValidatorInterface|null
     */
    private $keyValidator;

    public function __construct(array $options)
    {
        $this->keyValidator   = $options['keyValidator'] ?? null;
        $this->valueValidator = $options['valueValidator'] ?? null;
        $this->validationMode = $options['validationMode'] ?? self::VALIDATE_VALUE;

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($value, $data = [])
    {
        if (!is_array($value)) {
            $this->error(static::ERROR_NOT_ARRAY);

            return false;
        }

        $foundAnError = false;

        foreach ($value as $key => $val) {
            if ($this->validationMode === self::VALIDATE_VALUE || $this->validationMode === self::VALIDATE_BOTH) {
                if (!$this->valueValidator->isValid($val, $data)) {
                    $this->error(static::ERROR_NOT_ALL_VALID, $val);
                    $foundAnError = true;
                }
            }

            if ($this->validationMode === self::VALIDATE_KEY || $this->validationMode === self::VALIDATE_BOTH) {
                if (!$this->keyValidator->isValid($key, $data)) {
                    $this->error(static::ERROR_NOT_ALL_VALID, $key);
                    $foundAnError = true;
                }
            }
        }

        return !$foundAnError;
    }
}
