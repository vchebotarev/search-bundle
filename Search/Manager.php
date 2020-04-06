<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Manager implements ManagerInterface
{
    /**
     * @var OptionsInterface
     */
    private $defaultOptions;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var RequestHandlerInterface
     */
    private $requestHandler;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        RequestHandlerInterface $requestHandler,
        OptionsInterface $defaultOptions
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->requestHandler = $requestHandler;
        $this->defaultOptions = $defaultOptions;
    }

    public function createBuilder(): BuilderInterface
    {
        return new Builder($this, clone $this->defaultOptions);
    }

    public function createContainer($items, $totalCount, OptionsInterface $options): ContainerInterface
    {
        return new Container($items, $totalCount, $options);
    }

    public function getRequestHandler(): RequestHandlerInterface
    {
        return $this->requestHandler;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }
}
