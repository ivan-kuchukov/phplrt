<?php

/**
 * This file is part of phplrt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phplrt\Compiler\Grammar;

use Phplrt\Lexer\Token\Composite;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Source\Exception\NotAccessibleException;

class PP2PHPLexer implements LexerInterface
{
    /**
     * @var PhpLexer
     */
    private PhpLexer $lexer;

    /**
     * @var int
     */
    private int $depth = 0;

    /**
     * @param PhpLexer $lexer
     */
    public function __construct(PhpLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * @param resource|string $source
     * @param int $offset
     * @return iterable
     * @throws NotAccessibleException
     * @throws \RuntimeException
     */
    public function lex($source, int $offset = 0): iterable
    {
        $this->depth = 0;
        $children    = [];
        $value       = '';

        /** @var TokenInterface $inner */
        foreach ($this->lexer->lex($source, $offset) as $inner) {
            if ($inner->getName() === '{') {
                ++$this->depth;
            }

            if ($inner->getName() === '}') {
                --$this->depth;
            }

            if ($this->depth < 0) {
                break;
            }

            $children[] = $inner;
            $value .= $inner->getValue();
        }

        yield new Composite('T_PHP_CODE', $value, $offset, $children);
    }
}
