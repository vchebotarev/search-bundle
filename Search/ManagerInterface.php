<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface ManagerInterface
{
    /**
     * @param iterable         $items
     * @param int|int[]        $totalCount
     * @param OptionsInterface $options
     * @return ContainerInterface
     */
    public function createContainer(iterable $items, $totalCount, OptionsInterface $options) : ContainerInterface;

    /**
     * @return BuilderInterface
     */
    public function createBuilder() : BuilderInterface;

    /**
     * @return RequestHandlerInterface
     */
    public function getRequestHandler() : RequestHandlerInterface;

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher() : EventDispatcherInterface;

}
