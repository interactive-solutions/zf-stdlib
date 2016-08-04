<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Validator;

use DateTime;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

final class DateNotExpiredValidator extends AbstractValidator
{
    const DATE_EXPIRED = 'is:stdlib:date-expired';

    protected $messageTemplates = [
        self::DATE_EXPIRED => 'Date has already expired'
    ];

    /**
     * {@inheritdoc}
     */
    public function isValid($value)
    {
        if (new DateTime($value) < new DateTime('now')) {
            $this->error(self::DATE_EXPIRED);

            return false;
        }

        return true;
    }
}
