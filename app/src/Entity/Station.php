<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StationRepository::class)
 * @ORM\Table(name="stations")
 */
class Station
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="RentalOrder", mappedBy="pickUpStation")
     */
    private $orderPickUp;

    /**
     * @ORM\OneToMany(targetEntity="RentalOrder", mappedBy="returnStation")
     */
    private $orderReturn;

    public function __construct(string $name)
    {
        $this->name = $name;

        $this->orderPickUp = new ArrayCollection();
        $this->orderReturn = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
