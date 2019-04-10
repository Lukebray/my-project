<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BuysRepository")
 */
class Buys
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $timeplaced;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderaddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderstatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Login", inversedBy="buys")
     */
    private $customerID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTimeplaced(): ?\DateTimeInterface
    {
        return $this->timeplaced;
    }

    public function setTimeplaced(?\DateTimeInterface $timeplaced): self
    {
        $this->timeplaced = $timeplaced;

        return $this;
    }

    public function getOrderaddress(): ?string
    {
        return $this->orderaddress;
    }

    public function setOrderaddress(?string $orderaddress): self
    {
        $this->orderaddress = $orderaddress;

        return $this;
    }

    public function getOrderstatus(): ?string
    {
        return $this->orderstatus;
    }

    public function setOrderstatus(?string $orderstatus): self
    {
        $this->orderstatus = $orderstatus;

        return $this;
    }

    public function getCustomerID(): ?Login
    {
        return $this->customerID;
    }

    public function setCustomerID(?Login $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }
}
