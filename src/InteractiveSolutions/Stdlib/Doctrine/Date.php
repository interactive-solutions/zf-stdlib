<?php
/**
 * @copyright Interactive Solutions
 */

namespace InteractiveSolutions\Stdlib\Doctrine;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 * Custom DQL function returning the date of a datetime
 *
 * usage DATE(date)
 */
class Date extends FunctionNode
{
    public $date;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return "DATE(" . $sqlWalker->walkArithmeticPrimary($this->date) . ")";
    }
}
