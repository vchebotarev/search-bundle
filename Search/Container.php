<?php

namespace Chebur\SearchBundle\Search;

class Container implements ContainerInterface
{
    /**
     * @var iterable|array
     */
    protected $items;

    /**
     * @var int|int[]
     */
    protected $totalCount;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param iterable|array   $items
     * @param int|int[]        $totalCount
     * @param OptionsInterface $options
     */
    public function __construct($items, $totalCount, OptionsInterface $options)
    {
        $this->items      = $items;
        $this->totalCount = $totalCount;
        $this->options    = $options;
    }

    /**
     * @inheritdoc
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @inheritdoc
     */
    public function getOptions() : OptionsInterface
    {
        return $this->options;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        reset($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return current($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return key($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        next($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return key($this->items) !== null;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->items);
    }

}
