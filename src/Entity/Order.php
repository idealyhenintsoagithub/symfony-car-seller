<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    const STATUS_CART = 'cart';

    const STATUS_CART_VALIDATE = "cart_validate";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="cart", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $orderItems;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATUS_CART;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="orders", cascade={"persist"})
     */
    private $client;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        foreach ($this->getOrderItems() as $existOrderItem) {
            if ($existOrderItem->equals($orderItem)) {
                $existOrderItem->setQuantity(
                    $existOrderItem->getQuantity() + $orderItem->getQuantity()
                );

                return $this;
            }
        }
        
        $this->orderItems[] = $orderItem;
        $orderItem->setCart($this);
        
        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getCart() === $this) {
                $orderItem->setCart(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /* Calculates the order total.
    *
    * @return float
    */
   public function getTotal(): float
   {
       $total = 0;
   
       foreach ($this->getOrderItems() as $orderItem) {
           $total += $orderItem->getTotal();
       }
   
       return $total;
   }

   /**
     * Removes all items from the order.
     *
     * @return $this
     */
    public function removeAllOrderItem(): self
    {
        foreach ($this->getOrderItems() as $orderItem) {
            $this->removeOrderItem($orderItem);
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
