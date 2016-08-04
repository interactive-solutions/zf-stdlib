<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

namespace InteractiveSolutions\Stdlib\Validator;

use DomainException;

class AllEntitiesExistsValidator extends ObjectExists
{
    const ERROR_NO_ENTITIES_PROVIDED = 'noEntitiesProvided';
    const ERROR_NOT_ALL_EXISTS       = 'notAllExists';

    protected $messageTemplates = [
        self::ERROR_NOT_ALL_EXISTS       => 'No object matching \'%value%\' was found',
        self::ERROR_NO_ENTITIES_PROVIDED => 'No entities provided'
    ];

    /**
     * Validates that all entity ids maps to an existing entity
     *
     * @param array $value
     * @return bool
     */
    public function isValid($value)
    {
        if (!is_array($value)) {
            throw new DomainException();
        }

        if (empty($value)) {
            $this->error(self::ERROR_NO_ENTITIES_PROVIDED, $value);

            return false;
        }

        foreach ($value as $id) {
            if (!parent::isValid($id)) {
                $this->error(self::ERROR_NOT_ALL_EXISTS, $id);

                return false;
            }
        }

        return true;
    }
}
