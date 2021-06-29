<?php

namespace App\Entity;

use App\Repository\CampervanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampervanRepository::class)
 */
class Campervan
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
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRent = false;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function rentOut()
    {
        if ($this->isRent) {
            throw new \Exception('Van is already rented out');
        }

        $this->isRent = false;

        return $this;
    }

    public function returnVan(): self
    {
        $this->isRent = false;

        return $this;
    }
}
