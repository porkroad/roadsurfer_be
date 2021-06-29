<?php

namespace App\Controller;

use App\utils\AggregateStationEquipmentCount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationDashboardController extends AbstractController
{
    /**
     * @Route("/station-dashboard/{startDate}", name="base")
     */
    public function index(AggregateStationEquipmentCount $aggregateStationEquipmentCount, ?string $startDate = null): Response
    {
        try {
            $dateStart = $startDate === null
                ? new \DateTime() : new \DateTime($startDate);

            $equipmentCount = $aggregateStationEquipmentCount->aggregate($dateStart);


            return $this->render('station-dashboard/index.html.twig', [
                'controller_name' => 'BaseController',
                'equipmentCount' => $equipmentCount,
            ]);
        } catch (\Exception $e) {
            // log exception
            return $this->render('station-dashboard/index.html.twig', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
