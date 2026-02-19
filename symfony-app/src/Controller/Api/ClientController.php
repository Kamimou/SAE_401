<?php

namespace App\Controller\Api;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/clients', name: 'client_')]
class ClientController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ClientRepository $clientRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ClientRepository $clientRepository
    ) {
        $this->entityManager = $entityManager;
        $this->clientRepository = $clientRepository;
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $clients = $this->clientRepository->findAll();
        
        $data = array_map(function (Client $client) {
            return [
                'id' => $client->getId(),
                'raisonSociale' => $client->getRaisonSociale(),
                'adresseRue' => $client->getAdresseRue(),
                'codePostal' => $client->getCodePostal(),
                'ville' => $client->getVille(),
                'telephone' => $client->getTelephone(),
                'courriel' => $client->getCourriel(),
            ];
        }, $clients);

        return new JsonResponse($data, 200);
    }

    #[Route('/{id}', name: 'detail', methods: ['GET'])]
    public function detail(int $id): JsonResponse
    {
        $client = $this->clientRepository->find($id);

        if (!$client) {
            return new JsonResponse(['error' => 'Client not found'], 404);
        }

        $data = [
            'id' => $client->getId(),
            'raisonSociale' => $client->getRaisonSociale(),
            'adresseRue' => $client->getAdresseRue(),
            'codePostal' => $client->getCodePostal(),
            'ville' => $client->getVille(),
            'telephone' => $client->getTelephone(),
            'courriel' => $client->getCourriel(),
        ];

        return new JsonResponse($data, 200);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], 400);
        }

        $errors = $this->validateRequiredFields($data);
        if (!empty($errors)) {
            return new JsonResponse(['errors' => $errors], 400);
        }

        $client = new Client();
        $client->setRaisonSociale($data['raisonSociale']);
        $client->setAdresseRue($data['adresseRue']);
        $client->setCodePostal($data['codePostal']);
        $client->setVille($data['ville']);
        $client->setTelephone($data['telephone']);
        $client->setCourriel($data['courriel']);

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        $responseData = [
            'id' => $client->getId(),
            'raisonSociale' => $client->getRaisonSociale(),
            'adresseRue' => $client->getAdresseRue(),
            'codePostal' => $client->getCodePostal(),
            'ville' => $client->getVille(),
            'telephone' => $client->getTelephone(),
            'courriel' => $client->getCourriel(),
        ];

        return new JsonResponse($responseData, 201);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $client = $this->clientRepository->find($id);

        if (!$client) {
            return new JsonResponse(['error' => 'Client not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Invalid JSON'], 400);
        }

        $errors = $this->validateRequiredFields($data);
        if (!empty($errors)) {
            return new JsonResponse(['errors' => $errors], 400);
        }

        $client->setRaisonSociale($data['raisonSociale']);
        $client->setAdresseRue($data['adresseRue']);
        $client->setCodePostal($data['codePostal']);
        $client->setVille($data['ville']);
        $client->setTelephone($data['telephone']);
        $client->setCourriel($data['courriel']);

        $this->entityManager->flush();

        $responseData = [
            'id' => $client->getId(),
            'raisonSociale' => $client->getRaisonSociale(),
            'adresseRue' => $client->getAdresseRue(),
            'codePostal' => $client->getCodePostal(),
            'ville' => $client->getVille(),
            'telephone' => $client->getTelephone(),
            'courriel' => $client->getCourriel(),
        ];

        return new JsonResponse($responseData, 200);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $client = $this->clientRepository->find($id);

        if (!$client) {
            return new JsonResponse(['error' => 'Client not found'], 404);
        }

        $this->entityManager->remove($client);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }

    private function validateRequiredFields(array $data): array
    {
        $requiredFields = ['raisonSociale', 'adresseRue', 'codePostal', 'ville', 'telephone', 'courriel'];
        $errors = [];

        foreach ($requiredFields as $field) {
            $value = $data[$field] ?? null;
            if (!is_string($value) || trim($value) === '') {
                $errors[] = "The field '$field' is required";
            }
        }

        return $errors;
    }
}

