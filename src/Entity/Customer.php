<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SalesOrder", mappedBy="customer")
     */
    private $salesOrders;

    // Constructor, getters and setters, and other methods

    public function __construct()
    {
        $this->salesOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Collection|SalesOrder[]
     */
    public function getSalesOrders()
    {
        return $this->salesOrders;
    }

    public function addSalesOrder(SalesOrder $salesOrder): self
    {
        if (!$this->salesOrders->contains($salesOrder)) {
            $this->salesOrders[] = $salesOrder;
            $salesOrder->setCustomer($this);
        }
        return $this;
    }

    public function removeSalesOrder(SalesOrder $salesOrder): self
    {
        if ($this->salesOrders->contains($salesOrder)) {
            $this->salesOrders->removeElement($salesOrder);
            if ($salesOrder->getCustomer() === $this) {
                $salesOrder->setCustomer(null);
            }
        }
        return $this;
    }
}
