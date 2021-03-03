<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * StringToSlug Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class StringToSlug implements FilterInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed|string
     */
    public function filter($value)
    {
        if (!is_scalar($value)) {
            return $value;
        }

        $value = (string)$value;

        return preg_replace(
            '/[^0-9a-z]+/',
            '-',
            strtolower(
                transliterator_transliterate(
                    'Any-Latin; Latin-ASCII;',
                    $value
                )
            )
        );
    }
}
