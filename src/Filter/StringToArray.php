<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * StringToArray Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class StringToArray implements FilterInterface
{
    protected string $delimiter;

    /**
     * @var mixed
     */
    protected $limit = PHP_INT_MAX;

    /**
     * StringSplit constructor.
     *
     * @param $options
     */
    public function __construct($options)
    {
        if (!is_array($options)) {
            $this->delimiter = (string)$options;
        } else {
            foreach ($options as $option => $value) {
                $this->{$option} = $value;
            }
        }
    }

    /**
     * @param mixed $value
     *
     * @return array|mixed
     */
    public function filter($value)
    {
        if (!is_array($value)) {
            return explode($this->delimiter, (string)$value, $this->limit);
        }

        return $value;
    }
}
