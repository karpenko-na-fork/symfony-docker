<?php
// api/src/Document/Product.php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 *
 * @ODM\Document
 */
class Product
{
    /**
     * @ODM\Id(strategy="INCREMENT", type="int")
     */
    private $id;

    /**
     * @ODM\Field
     */
    public $name;

    /**
     * @ODM\ReferenceMany(targetDocument=Offer::class, mappedBy="product", cascade={"persist"}, storeAs="id")
     */
    public $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addOffer(Offer $offer): void
    {
        $offer->product = $this;
        $this->offers->add($offer);
    }

    public function removeOffer(Offer $offer): void
    {
        $offer->product = null;
        $this->offers->removeElement($offer);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}