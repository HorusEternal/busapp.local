<?php

namespace App\DataFixtures;

use App\Entity\Bus;
use App\Entity\Route;
use App\Entity\Schedule;
use App\Entity\Stop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Создание маршрутов
        $route1 = new Route();
        $route1->setDirection('в сторону ост. Попова');
        $manager->persist($route1);

        $route2 = new Route();
        $route2->setDirection('в сторону ост. Ленина');
        $manager->persist($route2);

        // Создание остановок
        $stop1 = new Stop();
        $stop1->setName('ул. Пушкина');
        $stop1->setRoute($route1);
        $manager->persist($stop1);

        $stop2 = new Stop();
        $stop2->setName('ул. Ленина');
        $stop2->setRoute($route2);
        $manager->persist($stop2);

        // Создание автобусов
        $bus1 = new Bus();
        $bus1->setNumber('11');
        $bus1->setRoute($route1);
        $manager->persist($bus1);

        $bus2 = new Bus();
        $bus2->setNumber('21');
        $bus2->setRoute($route2);
        $manager->persist($bus2);

        // Создание расписания
        $schedule1 = new Schedule();
        $schedule1->setBus($bus1);
        $schedule1->setFrom($stop1);
        $schedule1->setTo($stop2);
        $schedule1->setArrivalTimes(['08:15', '08:45', '09:15']);
        $manager->persist($schedule1);

        $schedule2 = new Schedule();
        $schedule2->setBus($bus2);
        $schedule2->setFrom($stop1);
        $schedule2->setTo($stop2);
        $schedule2->setArrivalTimes(['08:30', '09:00', '09:30']);
        $manager->persist($schedule2);

        $manager->flush();
    }
}
