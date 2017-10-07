<?php

namespace Chebur\SearchBundle\Search;

abstract class AbstractItemsSource
{
    /**
     * @param array|object $options
     * @param string       $sort
     * @param string       $sortOrder
     * @param int          $limit
     * @param int          $offset
     * @return array
     */
    final public function getItemAndTotalCount($options = [], $sort = '', $sortOrder = '', $limit = 0, int $offset = 0)
    {
        return [$this->getItems($options, $sort, $sortOrder, $limit, $offset), $this->getTotalCount($options),];
    }

    /**
     * @param array|object $options
     * @param string       $sort
     * @param string       $sortOrder
     * @param int          $limit
     * @param int          $offset
     * @return iterable
     */
    abstract protected function getItems($options = [], $sort = '', $sortOrder = '', $limit = 0, int $offset = 0) : iterable;

    /**
     * @param array|object $options
     * @return int|int[]
     */
    abstract protected function getTotalCount($options = []);

}
