<?php

namespace App\Controller;

use App\DTO\EditableStops;
use App\DTO\EditStopsRequest;
use App\Services\RouteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Route as RouteEntity;

class RouteController extends AbstractController
{
    #[Route('/api/route/edit-stops', name: 'route.edit_stops', methods: ['POST'])]
    public function editStops(
        #[MapRequestPayload] EditStopsRequest $editableStops,
        EntityManagerInterface $entityManager,
        RouteService $routeService
    ): JsonResponse
    {
        $route = $entityManager->getRepository(RouteEntity::class)->find( $editableStops->id);

        if (null === $route) {
            return new JsonResponse(['error' => 'Route not found'], Response::HTTP_NOT_FOUND);
        }

        $editedRoute = $routeService->editOrCreateStops($route, $editableStops->stops);

        $stops = [];
        foreach ($editedRoute->getStops() as $stop) {
            $stops[] = [
                'id' => $stop->getId(),
                'name' => $stop->getName(),
            ];
        }

        return $this->json([
            'message' => 'Route stops have been edited.',
            'data' => [
                'id' => $editedRoute->getId(),
                'stops' => $stops,
            ]
        ], Response::HTTP_OK);
    }
}
