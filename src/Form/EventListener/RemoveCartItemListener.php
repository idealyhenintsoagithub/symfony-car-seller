<?php

namespace App\Form\EventListener;

use App\Entity\Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RemoveCartItemListener implements EventSubscriberInterface
{
  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents(): array
  {
    return [FormEvents::POST_SUBMIT => 'onPostSubmit'];
  }

  public function onPostSubmit(FormEvent $event): void
  {
    $form = $event->getForm();
    $cart = $form->getData();

    if (!$cart instanceof Order) {
      return;
    }

    foreach($form->get('orderItems')->all() as $item) {
      if ($item->get('remove')->isClicked()) {
        $cart->removeOrderItem($item->getData());
        break;
      }
    }
  }
}