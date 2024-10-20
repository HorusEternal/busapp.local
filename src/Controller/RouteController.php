<?php

namespace App\Controller;

use App\Entity\Stop;
use App\Services\RouteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Route as RouteEntity;

class RouteController extends AbstractController
{
    #[Route('/api/route/edit-stops', name: 'route.edit_stops', methods: ['POST'])]
    public function editStops(Request $request, EntityManagerInterface $entityManager, RouteService $routeService): Response
    {
        $data = json_decode($request->getContent(), true);
        $routeId = $data['id'];
        $stopsData = $data['stops'];

        $route = $entityManager->getRepository(RouteEntity::class)->find($routeId);
        if (null === $route) {
            return new JsonResponse(['error' => 'route not found'], Response::HTTP_NOT_FOUND);
        }

        $editedRoute = $routeService->editStops($route, $stopsData);

        $stops = [];
        foreach ($editedRoute->getStops() as $stop) {
            $stops[] = [
                'id' => $stop->getId(),
                'name' => $stop->getName(),
            ];
        }

        return new JsonResponse(['message' => 'Route updated successfully', 'data' => [
            'id' => $editedRoute->getId(),
            'stops' => $stops,
        ]]);
    }
}
