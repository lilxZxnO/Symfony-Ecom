<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    private ?Order $myOreder = null;

    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[ORM\Column(length: 255)]
    private ?string $productuIllustration = null;

    #[ORM\Column]
    private ?int $productQuantity = null;

    #[ORM\Column]
    private ?float $productPrice = null;

    #[ORM\Column]
    private ?float $productTva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyOreder(): ?Order
    {
        return $this->myOreder;
    }

    public function setMyOreder(?Order $myOreder): static
    {
        $this->myOreder = $myOreder;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductuIllustration(): ?string
    {
        return $this->productuIllustration;
    }

    public function setProductuIllustration(string $productuIllustration): static
    {
        $this->productuIllustration = $productuIllustration;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): static
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice): static
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getProductTva(): ?float
    {
        return $this->productTva;
    }

    public function setProductTva(float $productTva): static
    {
        $this->productTva = $productTva;

        return $this;
    }
}
