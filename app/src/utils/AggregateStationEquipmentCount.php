<?php

namespace App\utils;

use App\Entity\PortableEquipment;
use App\Entity\RentalOrder;
use App\Repository\RentalOrderRepository;

class AggregateStationEquipmentCount
{
    /**
     * @var RentalOrderRepository
     */
    private $rentalOrderRepository;

    public function __construct(RentalOrderRepository $rentalOrderRepository)
    {
        $this->rentalOrderRepository = $rentalOrderRepository;
    }

    public function aggregate(\DateTime $dateStart)
    {
        $orders = $this->rentalOrderRepository->findOrdersAfterDate($dateStart);

        $orderedOrders = $this->aggregateOrders($orders);

        $days = $this->setUpDays($dateStart);

        return $this->aggregateEquipments($orderedOrders, $days);
    }

    private function aggregateEquipments(array $orderedOrders, array $days)
    {
        $equipmentCount = [];

        foreach ($orderedOrders as $orderedOrderByStation => $orders) {
            if (!isset($equipmentCount[$orderedOrderByStation])) {
                $equipmentCount[$orderedOrderByStation] = [];
            }

            foreach ($days as $day) {
                $dayFormatted = (new \DateTime())->setTimestamp($day)->format('Y-m-d');
                $equipmentCount[$orderedOrderByStation][$dayFormatted] = [];
                /** @var RentalOrder $order */
                foreach ($orders as $order) {
                    $startDate = $order->getStartDate()->getTimestamp();
                    $endDate = $order->getEndDate()->getTimestamp();
                    if ($startDate <= $day && $endDate >= $day) {
                        /** @var PortableEquipment $equipment */
                        foreach ($order->getEquipment() as $equipment) {
                            if (!isset($equipmentCount[$orderedOrderByStation][$dayFormatted][$equipment->getType()])) {
                                $equipmentCount[$orderedOrderByStation][$dayFormatted][$equipment->getType()] = 0;

                            }


                            $equipmentCount[$orderedOrderByStation][$dayFormatted][$equipment->getType()] += 1;
                        }
                    }
                }
            }
        }

        return $equipmentCount;
    }

    private function setUpDays(\DateTime $dateStart): array
    {
        $days = [];

        $start = new \DateTime();
        $start->setTimestamp($dateStart->getTimestamp());

        $days[] = $start->getTimestamp();

        for ($i = 1; $i < 7; $i++) {
            $days[] = $start->add(new \DateInterval('P1D'))->getTimestamp();
        }

        return $days;
    }

    /**
     * @param array|null $orders
     * @return array
     */
    public function aggregateOrders(?array $orders): array
    {
        $orderedOrders = [];
        foreach ($orders as $order) {
            if (!isset($orderedOrders[$order->getPickUpStation()->getName()])) {
                $orderedOrders[$order->getPickUpStation()->getName()] = [];
            }

            $orderedOrders[$order->getPickUpStation()->getName()][] = $order;
        }
        return $orderedOrders;
    }
}
