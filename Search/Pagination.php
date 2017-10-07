<?php

namespace Chebur\SearchBundle\Search;

class Pagination implements \Countable
{
    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var int
     */
    protected $totalCount;

    /**
     * @var int
     */
    protected $pagesCount;

    /**
     * @var int
     */
    protected $currentPageItemsCount;

    /**
     * @var int
     */
    protected $currentPageItemFirstIndex;

    /**
     * @var int
     */
    protected $currentPageItemLastIndex;

    /**
     * @param int $totalCount
     * @param int $perPage
     * @param int $page
     */
    public function __construct(int $totalCount, int $perPage, int $page = 1)
    {
        if ($totalCount < 0 || $perPage <= 0 || $page <= 0) {
            throw new \InvalidArgumentException('Wrong arguments passed');
        }
        $this->page       = $page;
        $this->totalCount = $totalCount;
        $this->perPage    = $perPage;

        $this->calculateAdditionals();
    }

    protected function calculateAdditionals()
    {
        $this->pagesCount = intval(ceil($this->getTotalCount() / $this->getPerPage()));

        $currentPageItemsCount       = $this->getTotalCount() - $this->getPerPage() * ($this->getPage() - 1);
        $this->currentPageItemsCount = $currentPageItemsCount >= 0 ? $currentPageItemsCount : 0;

        if ($this->currentPageItemsCount > 0) {
            $this->currentPageItemFirstIndex = $this->getPerPage() * ($this->getPage() - 1) + 1;
            $this->currentPageItemLastIndex  = $this->getPerPage() * ($this->getPage() - 1) + $this->currentPageItemsCount;
        } else {
            $this->currentPageItemFirstIndex = 0;
            $this->currentPageItemLastIndex  = 0;
        }
    }

    /**
     * @param int $rangeCount
     * @return array
     */
    public function getPageRange(int $rangeCount = 5)
    {
        if ($this->totalCount == 0) {
            return [];
        }

        if ($this->totalCount < $this->perPage) {
            return [1];
        }

        $current   = $this->page;
        $pageCount = $this->count();

        if ($rangeCount === null || $rangeCount >= $pageCount) {
            return range(1, $pageCount, 1);
        }

        $delta = ceil($rangeCount / 2);

        if ($current - $delta > $pageCount - $rangeCount) {
            $pageRange = range($pageCount - $rangeCount + 1, $pageCount);
        } else {
            if ($current - $delta < 0) {
                $delta = $current;
            }

            $offset = $current - $delta;
            $pageRange = range($offset + 1, $offset + $rangeCount);
        }

        return $pageRange;
    }

    /**
     * @return int
     */
    public function getPage() : int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage() : int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getTotalCount() : int
    {
        return $this->totalCount;
    }

    /**
     * @return int
     */
    public function getPageCount() : int
    {
        return $this->pagesCount;
    }

    /**
     * @return int
     */
    public function getCurrentPageItemsCount() : int
    {
        return $this->currentPageItemsCount;
    }

    /**
     * @return int|null
     */
    public function getCurrentPageItemFirstIndex() : int
    {
        return $this->currentPageItemFirstIndex;
    }

    /**
     * @return int|null
     */
    public function getCurrentPageItemLastIndex() : int
    {
        return $this->currentPageItemLastIndex;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->getPageCount();
    }

}
