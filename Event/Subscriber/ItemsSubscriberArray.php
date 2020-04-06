<?php

namespace Chebur\SearchBundle\Event\Subscriber;

use Chebur\SearchBundle\Event\Events;
use Chebur\SearchBundle\Event\ItemsEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ItemsSubscriberArray implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            Events::ITEMS => ['items'],
        ];
    }

    public function items(ItemsEvent $event): void
    {
        $itemsSource = $event->getSource();
        if (!is_array($itemsSource)) {
            return;
        }

        $items = array_slice(
            $itemsSource,
            $event->getOffset(),
            $event->getLimit()
        );
        $event->stopPropagation();

        $event->setItems($items);
        $event->setTotalCount(count($itemsSource));

        $event->stopPropagation();
    }
}
