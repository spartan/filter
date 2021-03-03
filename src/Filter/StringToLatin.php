<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * StringToLatin Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class StringToLatin implements FilterInterface
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

        return transliterator_transliterate('Any-Latin; Latin-ASCII;', $value);
    }
}
