<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Hydrator\Strategy;

use DateTime;
use Zend\Hydrator\Strategy\DefaultStrategy;

class DateTimeStrategy extends DefaultStrategy
{
    /**
     * {@inheritdoc}
     *
     * Convert a string value into a DateTime object
     */
    public function hydrate($value)
    {
        if (is_string($value)) {
            $value = new DateTime($value);
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     *
     * Convert a string value into a DateTime object
     */
    public function extract($value)
    {
        if (null === $value) {
            return null;
        }

        return $value->format(DateTime::ISO8601);
    }
}
