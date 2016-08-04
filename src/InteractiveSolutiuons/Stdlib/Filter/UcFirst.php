<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

namespace InteractiveSolutions\Stdlib\Filter;

use Zend\Filter\AbstractFilter;

class UcFirst extends AbstractFilter
{
    /**
     * Defined by Zend\Filter\FilterInterface
     *
     * Returns the string $value, removing all but alphabetic characters
     *
     * @param  string|array $value
     * @return string|array
     */
    public function filter($value)
    {
        $value = mb_strtolower($value, 'utf8');
        $strlen = mb_strlen($value, 'utf8');
        $firstChar = mb_substr($value, 0, 1, 'utf8');
        $then = mb_substr($value, 1, $strlen - 1, 'utf8');

        return mb_strtoupper($firstChar, 'utf8') . $then;
    }
}
