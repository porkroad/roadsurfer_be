<?php

namespace App\Entity;

use App\Repository\RentalOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalOrderRepository::class)
 */
class RentalOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Campervan")
     * @ORM\JoinTable(name="orders_vans",
     *      joinColumns={@ORM\JoinColumn(name="rental_order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="van_id", referencedColumnName="id")}
     *      )
     */
    private $van;

    /**
     * @ORM\ManyToOne(targetEntity="Station", inversedBy="orderPickUp")
     * @ORM\JoinTable(name="rental_order_pickup_stations")
     */
    private $pickUpStation;

    /**
     * @ORM\ManyToOne(targetEntity="Station", inversedBy="orderReturn")
     * @ORM\JoinTable(name="rental_order_return_stations")
     */
    private $returnStation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /** @ORM\ManyToMany(targetEntity="PortableEquipment", inversedBy="rentalOrders")
     * @ORM\JoinTable(
     *  name="rental_orders_equipments",
     *  joinColumns={
     *      @ORM\JoinColumn(name="rental_order_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="equipment_id", referencedColumnName="id")
     *  }
     * )
     */
    private $equipment;

    public function __construct(
        ArrayCollection $vans,
        Station         $pickUpStation,
        Station         $returnStation,
        \DateTime       $startDate,
        \DateTime       $endDate,
        ArrayCollection $equipment = null
    )
    {
        $this->van = $vans;
        $this->pickUpStation = $pickUpStation;
        $this->returnStation = $returnStation;
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        if ($equipment === null) {
            $equipment = new ArrayCollection();
        }

        $this->equipment = $equipment;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Station
     */
    public function getReturnStation(): Station
    {
        return $this->returnStation;
    }

    /**
     * @return Station
     */
    public function getPickUpStation(): Station
    {
        return $this->pickUpStation;
    }

    public function getEquipment(): ?Collection
    {
        return $this->equipment;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }
}
