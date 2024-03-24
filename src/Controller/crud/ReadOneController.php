<?php

namespace App\Controller\crud;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class ReadOneController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function readOne($id): Response
    {
        $client = $this->entityManager->getRepository(Client::class)->find($id);

        if (!$client) {
            $this->addFlash('error', 'Client not Found!');
            throw $this->createNotFoundException(
                'No client found for id '.$id
            );
        }

        $comments = $client->getComments();

        return $this->render('crud/read_one.html.twig', [
            'client' => $client,
            'comments' => $comments,
        ]);

    }
}