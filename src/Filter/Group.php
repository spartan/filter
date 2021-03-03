<?php

namespace Spartan\Filter\Filter;

use Laminas\Filter\FilterInterface;

/**
 * Group Filter
 *
 * @package Spartan\Filter
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class Group implements FilterInterface
{
    protected array $aliases = [
        'alnum'     => \Laminas\I18n\Filter\Alnum::class,
        'alpha'     => \Laminas\I18n\Filter\Alpha::class,
        'digit'     => \Laminas\Filter\Digits::class,
        'float'     => \Laminas\Filter\ToFloat::class,
        'int'       => \Laminas\Filter\ToInt::class,
        'bool'      => \Laminas\Filter\Boolean::class,
        'lowercase' => \Laminas\Filter\StringToLower::class,
        'uppercase' => \Laminas\Filter\StringToUpper::class,
        'trim'      => \Laminas\Filter\StringTrim::class,
        'blacklist' => \Laminas\Filter\Blacklist::class,
        'whitelist' => \Laminas\Filter\Whitelist::class,
        'latin'     => StringToLatin::class,
        'titlecase' => StringToTitle::class,
        'empty'     => EmptyToNull::class,
        'slug'      => StringToSlug::class,
        'join'      => ArrayToString::class,
        'split'     => StringToArray::class,
    ];

    protected array $filters = [];

    /**
     * Filter constructor.
     *
     * @param       $filters
     * @param array $aliases
     */
    public function __construct($filters, array $aliases = [])
    {
        $this->filters = is_string($filters)
            ? array_filter(explode(',', $filters))
            : (array)$filters;
        $this->aliases = $aliases + $this->aliases;
    }

    /**
     * @param array $filters
     *
     * @return $this
     */
    public function withFilters(array $filters): self
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    /**
     * @param array $aliases
     *
     * @return $this
     */
    public function withAliases(array $aliases): self
    {
        $this->aliases = $aliases + $this->aliases;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter($value)
    {
        foreach ($this->filters as $filter) {
            $options = [];
            if (is_array($filter)) {
                $options = current($filter);
                $filter  = key($filter);
            }

            if (is_string($filter) && isset($this->aliases[$filter])) {
                $filter = $this->aliases[$filter];
            }

            if (is_string($filter)) {
                $filterObject = new $filter($options);
            } else {
                $filterObject = $filter;
            }

            if ($filterObject instanceof FilterInterface) {
                $value = $filterObject->filter($value);
            } else {
                // closure
                $value = $filter($value);
            }
        }

        return $value;
    }
}
