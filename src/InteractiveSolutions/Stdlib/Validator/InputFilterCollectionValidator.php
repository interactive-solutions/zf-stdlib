<?php
/**
 * @author    Jonas Eriksson <jonas.eriksson@interactivesolutions.se>
 *
 * @copyright Interactive Solutions
 */
declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Validator;

use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\AbstractValidator;

class InputFilterCollectionValidator extends AbstractValidator
{
    const ERROR_NOT_ARRAY = 'error_not_array';

    protected $messageTemplates = [
        self::ERROR_NOT_ARRAY => 'Value is not an array',
    ];

    /**
     * @var InputFilterInterface
     */
    private $inputFilter;

    /**
     * @var array
     */
    private $messages;

    public function __construct(array $options)
    {
        $this->inputFilter = $options['inputFilter'];

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($values, $context = null)
    {
        if (!is_array($values)) {
            $this->error(static::ERROR_NOT_ARRAY);

            return false;
        }

        $this->inputFilter->setData($values);

        if (!$this->inputFilter->isValid()) {

            $i = 0;
            foreach($this->inputFilter->getMessages() as $field => $errors) {
                foreach($errors as $key => $string) {
                    $this->messages[$i][$field][$key] = $string;
                    $i++;
                }
            }

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
