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
    public function editStops(Route $route, array $stops): Route {
        foreach ($route->getStops() as $stop) {
            $this->entityManager->remove($stop);
        }

        foreach ($stops as $stopData) {
            $stop = new Stop();
            $stop->setName($stopData->name);
            $stop->setRoute($route);
            $this->entityManager->persist($stop);
        }

        $this->entityManager->flush();


        return $route;
    }
}