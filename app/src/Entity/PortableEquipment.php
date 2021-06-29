<?php

namespace App\Entity;

use App\Repository\PortableEquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PortableEquipmentRepository::class))
 */
class PortableEquipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Station")
     */
    private $station;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="RentalOrder", mappedBy="equipment")
     */
    private $rentalOrders;

    public function __construct(Station $station, int $count, string $type)
    {
        $this->setStation($station);
        $this->count = $count;
        $this->setType($type);

        $this->rentalOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * @param mixed $station
     */
    public function setStation(Station $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function rentOut(): void
    {
        if ($this->count > 0) {
            $this->count -= 1;

            return;
        }

        throw new \Exception(sprintf('no more equipment of type %s left on station %s', $this->type, $this->station));
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
