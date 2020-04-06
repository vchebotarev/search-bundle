<?php

namespace Chebur\SearchBundle\Search;

class Container implements ContainerInterface
{
    /**
     * @var iterable|array
     */
    private $items;

    /**
     * @var int|int[]
     */
    private $totalCount;

    /**
     * @var array
     */
    private $options;

    /**
     * @param iterable|array   $items
     * @param int|int[]        $totalCount
     */
    public function __construct($items, $totalCount, OptionsInterface $options)
    {
        $this->items      = $items;
        $this->totalCount = $totalCount;
        $this->options    = $options;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function getOptions(): OptionsInterface
    {
        return $this->options;
    }

    public function rewind()
    {
        reset($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next()
    {
        next($this->items);
    }

    public function valid()
    {
        return key($this->items) !== null;
    }

    public function count()
    {
        return count($this->items);
    }
}
