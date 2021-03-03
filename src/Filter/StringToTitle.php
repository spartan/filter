<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * StringToTitle Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class StringToTitle implements FilterInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed|null|string|string[]
     */
    public function filter($value)
    {
        if (!is_scalar($value)) {
            return $value;
        }

        $value = (string)$value;

        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
