<?php

namespace App\Manager;
use App\Entity\Order;

class StockManager
{
  public function process(Order $cart): void
  {
    foreach ($cart->getOrderItems() as $cartitem) {
      $product = $cartitem->getProduct();
      $product->setStock($product->getStock() - $cartitem->getQuantity());
    }
  }
}