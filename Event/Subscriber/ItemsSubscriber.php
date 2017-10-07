<?php

namespace Chebur\SearchBundle\Event\Subscriber;

use Chebur\SearchBundle\Event\Events;
use Chebur\SearchBundle\Event\ItemsEvent;
use Chebur\SearchBundle\Search\AbstractItemsSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ItemsSubscriber implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::ITEMS => ['items'],
        ];
    }

    /**
     * @param ItemsEvent $event
     */
    public function items(ItemsEvent $event)
    {
        $itemsSource = $event->getSource();
        if (!$itemsSource instanceof AbstractItemsSource) {
            return;
        }

        list($items, $totalCount) = $itemsSource->getItemAndTotalCount(
            $event->getOptions(),
            $event->getSort(),
            $event->getSortOrder(),
            $event->getLimit(),
            $event->getOffset()
        );
        if (is_array($totalCount)) {
            $totalCount = array_sum($totalCount);
        }
        $event->setItems($items);
        $event->setTotalCount($totalCount);

        $event->stopPropagation();
    }

}
