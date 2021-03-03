<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * ArrayToString Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class ArrayToString implements FilterInterface
{
    protected string $glue;

    /**
     * StringSplit constructor.
     *
     * @param $options
     */
    public function __construct($options)
    {
        if (!is_array($options)) {
            $this->glue = $options;
        } else {
            foreach ($options as $option => $value) {
                $this->{$option} = $value;
            }
        }
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function filter($value)
    {
        if (is_array($value)) {
            implode($this->glue, $value);
        }

        return $value;
    }
}
