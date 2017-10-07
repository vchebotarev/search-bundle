<?php

namespace Chebur\SearchBundle\Search;

interface ContainerInterface extends \Iterator, \Countable
{
    /**
     * @return iterable
     */
    public function getItems() : iterable;

    /**
     * @return int|int[]
     */
    public function getTotalCount();

    /**
     * @return OptionsInterface
     */
    public function getOptions() : OptionsInterface;

}
