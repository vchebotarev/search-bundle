<?php

namespace Chebur\SearchBundle\Search;

use Countable;
use InvalidArgumentException;

class Pagination implements Countable
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var int
     */
    private $pagesCount;

    /**
     * @var int
     */
    private $currentPageItemsCount;

    /**
     * @var int
     */
    private $currentPageItemFirstIndex;

    /**
     * @var int
     */
    private $currentPageItemLastIndex;

    public function __construct(int $totalCount, int $perPage, int $page = 1)
    {
        if ($totalCount < 0 || $perPage <= 0 || $page <= 0) {
            throw new InvalidArgumentException('Wrong arguments passed');
        }
        $this->page = $page;
        $this->totalCount = $totalCount;
        $this->perPage = $perPage;

        $this->calculateAdditions();
    }

    private function calculateAdditions()
    {
        $this->pagesCount = intval(ceil($this->getTotalCount() / $this->getPerPage()));

        $currentPageItemsCount = $this->getTotalCount() - $this->getPerPage() * ($this->getPage() - 1);
        $this->currentPageItemsCount = $currentPageItemsCount >= 0 ? $currentPageItemsCount : 0;

        if ($this->currentPageItemsCount > 0) {
            $this->currentPageItemFirstIndex = $this->getPerPage() * ($this->getPage() - 1) + 1;
            $this->currentPageItemLastIndex  = $this->getPerPage() * ($this->getPage() - 1) + $this->currentPageItemsCount;
        } else {
            $this->currentPageItemFirstIndex = 0; //todo null
            $this->currentPageItemLastIndex = 0; //todo null
        }
    }

    public function getPageRange(?int $rangeCount = 5): array
    {
        if ($this->totalCount === 0) {
            return [];
        }

        if ($this->totalCount < $this->perPage) {
            return [1];
        }

        if ($rangeCount === null || $rangeCount >= $this->pagesCount) {
            return range(1, $this->pagesCount);
        }

        $delta = (int)ceil($rangeCount / 2); //4.3 -> 5

        if ($this->page - $delta > $this->pagesCount - $rangeCount) {
            return range($this->pagesCount - $rangeCount + 1, $this->pagesCount);
        }

        if ($this->page - $delta < 0) {
            $delta = $this->page;
        }
        $offset = $this->page - $delta;

        return range($offset + 1, $offset + $rangeCount);
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getPageCount(): int
    {
        return $this->pagesCount;
    }

    public function getCurrentPageItemsCount(): int
    {
        return $this->currentPageItemsCount;
    }

    public function getCurrentPageItemFirstIndex(): int
    {
        return $this->currentPageItemFirstIndex;
    }

    public function getCurrentPageItemLastIndex(): int
    {
        return $this->currentPageItemLastIndex;
    }

    public function count()
    {
        return $this->getPageCount();
    }
}
