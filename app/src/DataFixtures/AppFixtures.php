<?php

namespace App\DataFixtures;

use App\Entity\Campervan;
use App\Entity\PortableEquipment;
use App\Entity\RentalOrder;
use App\Entity\Station;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $station1 = new Station('station 1');
        $manager->persist($station1);
        $station2 = new Station('station 2');
        $manager->persist($station2);

        $van = new Campervan('VW T5');
        $manager->persist($van);

        $van2 = new Campervan('VW T6');
        $manager->persist($van2);

        $equipmentsStation1 = new ArrayCollection();
        $equipmentToilet = new PortableEquipment($station1, 5, 'Toilet');
        $manager->persist($equipmentToilet);
        $equipmentsStation1->add($equipmentToilet);

        $equipmentBedSheets = new PortableEquipment($station1, 5, 'bed sheets');
        $manager->persist($equipmentBedSheets);
        $equipmentsStation1->add($equipmentBedSheets);

        $equipmentsStation2 = new ArrayCollection();
        $equipmentToilet2 = new PortableEquipment($station2, 5, 'toilet');
        $manager->persist($equipmentToilet2);
        $equipmentsStation2->add($equipmentToilet2);

        $equipmentCoolingBox = new PortableEquipment($station2, 5, 'cooling box');
        $manager->persist($equipmentCoolingBox);
        $equipmentsStation2->add($equipmentCoolingBox);


        $order = new RentalOrder(
            new ArrayCollection([$van]),
            $station1,
            $station2,
            new \DateTime(),
            new \DateTime('2021-08-08'),
            $equipmentsStation1
        );

        $manager->persist($order);

        $order2 = new RentalOrder(
            new ArrayCollection([$van2]),
            $station2,
            $station1,
            new \DateTime(),
            new \DateTime('2021-08-08'),
            $equipmentsStation2
        );

        $manager->persist($order2);

        $order3 = new RentalOrder(
            new ArrayCollection([$van2]),
            $station2,
            $station1,
            new \DateTime(),
            new \DateTime('2021-08-08'),
            new ArrayCollection([$equipmentToilet2])
        );
        $manager->persist($order3);

        $order4 = new RentalOrder(
            new ArrayCollection([$van2]),
            $station2,
            $station1,
            new \DateTime('2021-06-29'),
            new \DateTime('2021-07-04'),
            new ArrayCollection([$equipmentToilet2])
        );
        $manager->persist($order4);

        $manager->flush();
    }
}
