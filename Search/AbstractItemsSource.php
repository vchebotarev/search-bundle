<?php

namespace Chebur\SearchBundle\Search;

abstract class AbstractItemsSource
{
    /**
     * @param mixed  $options
     * @param string $sort
     * @param string $sortOrder
     * @param int    $limit
     * @param int    $offset
     * @return array
     */
    public function getItemAndTotalCount($options, $sort = '', $sortOrder = '', $limit = 0, int $offset = 0)
    {
        return [$this->getItems($options, $sort, $sortOrder, $limit, $offset), $this->getTotalCount($options),];
    }

    /**
     * @param mixed  $options
     * @param string $sort
     * @param string $sortOrder
     * @param int    $limit
     * @param int    $offset
     * @return iterable|array
     */
    abstract protected function getItems($options, $sort = '', $sortOrder = '', $limit = 0, int $offset = 0);

    /**
     * @param mixed $options
     * @return int|int[]
     */
    abstract protected function getTotalCount($options);

}
