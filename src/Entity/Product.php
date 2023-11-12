<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Trait\CreatedAtTrait;
use App\Trait\SlugTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Product
{
    use CreatedAtTrait;
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide')]
    #[Assert\Length(
        min: 4,
        max: 100,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères.',
        maxMessage: 'Le nom doit ne doit pas faire plus de {{ limit }} caractères.'
    )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'La description ne peut pas être vide')]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    #[Assert\NotBlank(message: 'Le prix ne peut pas être vide')]
    private ?string $price = null;

    #[ORM\Column(nullable: true, options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: 'La remise ne peut pas être négative')]
    #[Assert\LessThan(
        value: 101,
        message: 'La remise ne doit ne doit pas dépasser 100 %.'
    )]
    private ?int $discount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThanOrEqual('today', message: 'La remise doit commencer au plus tôt aujourd\'hui')]
    private ?\DateTimeInterface $discount_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThanOrEqual(propertyPath: 'discountStart', message: 'La remise ne peut pas expirer avant sa date de début')]
    private ?\DateTimeInterface $discount_end = null;

    #[ORM\Column(length: 255, nullable: true)]
    /* #[Assert\File(
        maxSize:1024,
        maxSizeMessage: 'Le poids de l\'image ne doit pas excéder 100 ko.',
        extensions: [
            'jpg',
            'jpeg',
            'png',
            'gif'
        ],
        extensionsMessage:'Format d\'image incorrect : les formats jpg, jpeg, png et gif sont acceptés.'
    )]
    /* #[Assert\Image(
        allowLandscape: false,
        allowLandscapeMessage:'L\'image doit être au format carré',
        allowPortrait: false,
        allowPortraitMessage:'L\'image doit être au format carré',
        minWidth: 600,
        minWidthMessage:'L\'image doit avoir une taille de {{minWidth}} x {{minWidth}} px',
        maxWidth: 600,
        maxWidthMessage:'L\'image doit avoir une taille de {{maxWidth}} x {{maxWidth}} px',
        minHeight: 600,
        minHeightMessage:'L\'image doit avoir une taille de {{minHeight}} x {{minHeight}} px',
        maxHeight: 600,
        maxHeightMessage:'L\'image doit avoir une taille de {{maxHeight}} x {{maxHeight}} px'
    )] */
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'La catégorie ne peut pas être vide')]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscountStart(): ?\DateTimeInterface
    {
        return $this->discount_start;
    }

    public function setDiscountStart(?\DateTimeInterface $discount_start): static
    {
        $this->discount_start = $discount_start;

        return $this;
    }

    public function getDiscountEnd(): ?\DateTimeInterface
    {
        return $this->discount_end;
    }

    public function setDiscountEnd(?\DateTimeInterface $discount_end): static
    {
        $this->discount_end = $discount_end;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}