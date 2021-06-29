<?php

namespace App\Controller;

use App\utils\AggregateStationEquipmentCount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationApiController extends AbstractController
{
    /**
     * @Route("/station/aggregate/{startDate}", name="station_api")
     */
    public function getAggregatedStations(AggregateStationEquipmentCount $aggregateStationEquipmentCount, ?string $startDate = null): Response
    {
        try {
            $dateStart = $startDate === null
                ? new \DateTime() : new \DateTime($startDate);

            $equipmentCount = $aggregateStationEquipmentCount->aggregate($dateStart);

        } catch (\Exception $e) {
            //log exception
            $equipmentCount = [];
        }

        return $this->json($equipmentCount);
    }
}
