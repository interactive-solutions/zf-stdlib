<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Doctrine;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Cast extends FunctionNode
{
    /**
     * @var mixed
     */
    private $column;

    /**
     * @var mixed
     */
    private $type;

    /**
     * @param SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('CAST(%s AS %s)',  $this->column->dispatch($sqlWalker), $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->column = $parser->StringPrimary();

        $parser->match(Lexer::T_AS);

        $parser->match(Lexer::T_IDENTIFIER);
        $lexer = $parser->getLexer();

        $this->type = $lexer->token['value'];

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
