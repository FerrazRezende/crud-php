<?php
namespace App\Controller\crud;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class ReadController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function read(): Response
    {
        $repository = $this->entityManager->getRepository(Client::class);
        $clients = $repository->findAll();

        return $this->render('crud/read.html.twig', [
            'clients' => $clients
        ]);
    }
}

