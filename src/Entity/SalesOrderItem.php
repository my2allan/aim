<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalesOrderItemRepository")
 */
class SalesOrderItem
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
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SalesOrder", inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salesOrder;

    // Getters and setters for the properties

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getSalesOrder(): ?SalesOrder
    {
        return $this->salesOrder;
    }

    public function setSalesOrder(?SalesOrder $salesOrder): self
    {
        $this->salesOrder = $salesOrder;
        return $this;
    }
}
