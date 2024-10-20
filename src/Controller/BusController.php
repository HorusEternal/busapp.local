<?php

namespace App\Controller;

use App\Entity\Stop;
use App\Services\BusFinderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BusController extends AbstractController
{
    #[Route('/api/find-bus', name: 'find_bus', methods: ['GET'])]
    public function findBus(Request $request, BusFinderService $busFinderService, EntityManagerInterface $entityManager): JsonResponse
    {
        $fromId = $request->query->get('from');
        $toId = $request->query->get('to');

        $fromStop = $entityManager->getRepository(Stop::class)->find($fromId);
        $toStop = $entityManager->getRepository(Stop::class)->find($toId);

        if(!$fromStop || !$toStop) {
            return new JsonResponse([
                'error' => 'Stops not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $response = $busFinderService->findBuses($fromStop, $toStop);

        return new JsonResponse($response);
    }
}
