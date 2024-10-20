<?php

namespace App\Services;

use App\DTO\EditableStops;
use App\Entity\Route;
use App\Entity\Stop;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RouteService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    /**
     * @param Route $route
     * @param EditableStops[] $stops
     * @return Route
     */
    public function editOrCreateStops(Route $route, array $stops): Route {

        foreach ($stops as $stopData) {
            $stop = $stopData->id ? $this->entityManager->getRepository(Stop::class)->find($stopData->id) : null;
            if ($stop) {
                $stop->setName($stopData->name);
            } else {
                $newStop = new Stop();
                $newStop->setName($stopData->name);
                $newStop->setRoute($route);
                $this->entityManager->persist($newStop);
            }
        }

        $this->entityManager->flush();


        return $route;
    }
}