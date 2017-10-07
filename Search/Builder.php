<?php

namespace Chebur\SearchBundle\Search;

use Chebur\SearchBundle\Event\Events;
use Chebur\SearchBundle\Event\ItemsEvent;
use Symfony\Component\HttpFoundation\Request;

class Builder implements BuilderInterface
{
    /**
     * @var OptionsInterface
     */
    protected $options;

    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface      $manager
     * @param OptionsInterface|null $options
     */
    public function __construct(ManagerInterface $manager, OptionsInterface $options)
    {
        $this->manager = $manager;
        $this->options = $options;
        //возможно стоит добавить установку хендлера, диспатчера и опций извне?
    }

    /**
     * @inheritdoc
     */
    public function build(Request $request = null) : ContainerInterface
    {
        if ($this->options->getItemsSource() === null) {
            throw new \InvalidArgumentException('Items source must be configured');
        }

        $this->manager->getRequestHandler()->handleRequest($this->options, $request);

        $this->options->resolveOptions();

        $sort         = $this->options->getSort();
        $sortOrder    = $this->options->getOrder();
        $limit        = $this->options->getLimit();
        $offset       = $this->options->getOffset();
        $itemsSource  = $this->options->getItemsSource();
        $itemsOptions = $this->options->getItemsOptions();

        $itemsEvent = new ItemsEvent($itemsSource, $itemsOptions, $sort, $sortOrder, $limit, $offset); //может тоже через менеджер пустить ?
        $this->manager->getEventDispatcher()->dispatch(Events::ITEMS, $itemsEvent);
        if (!$itemsEvent->isPropagationStopped()) {
            throw new \RuntimeException('One of listeners must count and slice given items source');
        }

        $items           = $itemsEvent->getItems();
        $itemsTotalCount = $itemsEvent->getTotalCount();

        $searchContainer = $this->manager->createContainer($items, $itemsTotalCount, clone $this->options);

        return $searchContainer;
    }

    /**
     * @inheritdoc
     */
    public function setPage(int $page = 1)
    {
        $this->options->setPage($page);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setLimit(int $limit = 0)
    {
        $this->options->setLimit($limit);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setSort(string $sort, string $order = null)
    {
        $this->options->setSort($sort);
        if ($order !== null) {
            $this->options->setOrder($order);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPageRange(int $pageRange)
    {
        $this->options->setPageRange($pageRange);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setLimits(array $limits)
    {
        $this->options->setLimits($limits);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setSorts(array $sorts)
    {
        $this->options->setSorts($sorts);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setItemsSource($source, $options = null)
    {
        $this->options->setItemsSource($source);
        if ($options !== null) {
            $this->options->setItemsOptions($options);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setRoute(string $route, array $routeParams = null)
    {
        $this->options->setRoute($route);
        if ($routeParams !== null) {
            $this->options->setRouteParams($routeParams);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTemplatePagination(string $template)
    {
        $this->options->setTemplatePagination($template);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTemplateLimitation(string $template)
    {
        $this->options->setTemplateLimitation($template);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTemplateSorting(string $template)
    {
        $this->options->setTemplateSorting($template);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setParamNamePage(string $paramName)
    {
        $this->options->setParamNamePage($paramName);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setParamNameLimit(string $paramName)
    {
        $this->options->setParamNameLimit($paramName);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setParamNameSort(string $paramName)
    {
        $this->options->setParamNameSort($paramName);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setParamNameOrder(string $paramName)
    {
        $this->options->setParamNameOrder($paramName);
        return $this;
    }

}
