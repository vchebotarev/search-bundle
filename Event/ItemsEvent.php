<?php

namespace Chebur\SearchBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ItemsEvent extends Event
{
    /**
     * @var array|object
     */
    private $source;

    /**
     * @var mixed
     */
    private $options;

    /**
     * @var string
     */
    private $sort;

    /**
     * @var string
     */
    private $sortOrder;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var iterable|array
     */
    private $items;

    /**
     * @param array|object $source
     * @param mixed $options
     */
    public function __construct($source, $options, string $sort = '', string $sortOrder = '', int $limit = 0, int $offset = 0)
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

    public function getSort(): string
    {
        return $this->sort;
    }

    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
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
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function setTotalCount(int $totalCount): void
    {
        $this->totalCount = $totalCount;
    }
}
