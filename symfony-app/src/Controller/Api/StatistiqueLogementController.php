<?php

namespace App\Controller\Api;

use App\Entity\StatistiqueLogement;
use App\Repository\StatistiqueLogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/statistique_logements', name: 'statistique_logement_')]
class StatistiqueLogementController extends AbstractController
{
    private StatistiqueLogementRepository $repository;

    public function __construct(StatistiqueLogementRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $statistiques = $this->repository->findAll();

        $data = array_map(function (StatistiqueLogement $statistique) {
            return [
                'id' => $statistique->getId(),
                'nombreLogement' => $statistique->getNombreLogement(),
                'construction' => $statistique->getConstruction(),
            ];
        }, $statistiques);

        return new JsonResponse($data, 200);
    }
}
