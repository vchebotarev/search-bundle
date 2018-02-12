<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Manager implements ManagerInterface
{
    /**
     * @var OptionsInterface
     */
    protected $defaultOptions;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param RequestHandlerInterface  $requestHandler
     * @param OptionsInterface         $defaultOptions
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, RequestHandlerInterface $requestHandler, OptionsInterface $defaultOptions)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->requestHandler  = $requestHandler;
        $this->defaultOptions  = $defaultOptions;
    }

    /**
     * @inheritdoc
     */
    public function createBuilder() : BuilderInterface
    {
        return new Builder($this, clone $this->defaultOptions);
    }

    /**
     * @inheritdoc
     */
    public function createContainer($items, $totalCount, OptionsInterface $options) : ContainerInterface
    {
        return new Container($items, $totalCount, $options);
    }

    /**
     * @inheritdoc
     */
    public function getRequestHandler() : RequestHandlerInterface
    {
        return $this->requestHandler;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher() : EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

}
