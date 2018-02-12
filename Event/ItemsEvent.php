<?php

namespace Chebur\SearchBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ItemsEvent extends Event
{
    /**
     * @var array|object
     */
    protected $source;

    /**
     * @var mixed
     */
    protected $options;

    /**
     * @var string
     */
    protected $sort;

    /**
     * @var string
     */
    protected $sortOrder;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var int
     */
    protected $totalCount;

    /**
     * @var iterable|array
     */
    protected $items;

    /**
     * @param array|object $source
     * @param mixed        $options
     * @param string       $sort
     * @param string       $sortOrder
     * @param int          $limit
     * @param int          $offset
     */
    public function __construct($source, $options, $sort = '', $sortOrder = '', $limit = 0, $offset = 0)
    {
        $this->source    = $source;
        $this->options   = $options;
        $this->sort      = $sort;
        $this->sortOrder = $sortOrder;
        $this->limit     = $limit;
        $this->offset    = $offset;
    }

    /**
     * @return array|object
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return iterable|array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param iterable|array $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
        return $this;
    }

}
