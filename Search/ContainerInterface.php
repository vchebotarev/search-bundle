<?php

namespace Chebur\SearchBundle\Search;

interface ContainerInterface extends \Iterator, \Countable
{
    /**
     * @return iterable|array
     */
    public function getItems();

    /**
     * @return int|int[]
     */
    public function getTotalCount();

    /**
     * @return OptionsInterface
     */
    public function getOptions() : OptionsInterface;

}
