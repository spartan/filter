<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * EmptyToNull Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class EmptyToNull implements FilterInterface
{
    /**
     * @param mixed $value
     *
     * @return bool|mixed
     */
    public function filter($value)
    {
        // true empty
        if (is_scalar($value) && strlen((string)$value) > 0) {
            return $value;
        }

        return empty($value);
    }
}
