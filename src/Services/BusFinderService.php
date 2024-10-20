<?php

namespace App\Services;

use App\DTO\FindBusResponse;
use App\Entity\Schedule;
use App\Entity\Stop;
use Doctrine\ORM\EntityManagerInterface;

final readonly class BusFinderService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function findBuses(Stop $from, Stop $to): FindBusResponse
    {
        $schedules = $this->entityManager
            ->getRepository(Schedule::class)
            ->findBy(['from' => $from, 'to' => $to]);

        $buses = [];
        foreach ($schedules as $schedule) {
            $buses[] = [
                'route' => 'Автобус №' . $schedule->getBus()->getNumber() . ' ' . $schedule->getBus()->getRoute()->getDirection(),
                'next_arrivals' => array_slice($schedule->getArrivalTimes(), 0, 3),
            ];
        }

        return new FindBusResponse($from->getName(), $to->getName(), $buses);
    }
}