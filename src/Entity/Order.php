<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Login", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customerId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="orders")
     */
    private $productID;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeOfOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryAddress;

    public function __construct()
    {
        $this->productID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerId(): ?Login
    {
        return $this->customerId;
    }

    public function setCustomerId(?Login $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductID(): Collection
    {
        return $this->productID;
    }

    public function addProductID(Product $productID): self
    {
        if (!$this->productID->contains($productID)) {
            $this->productID[] = $productID;
        }

        return $this;
    }

    public function removeProductID(Product $productID): self
    {
        if ($this->productID->contains($productID)) {
            $this->productID->removeElement($productID);
        }

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTimeOfOrder(): ?\DateTimeInterface
    {
        return $this->timeOfOrder;
    }

    public function setTimeOfOrder(\DateTimeInterface $timeOfOrder): self
    {
        $this->timeOfOrder = $timeOfOrder;

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

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }
}
