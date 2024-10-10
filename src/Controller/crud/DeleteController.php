<?php

namespace App\Controller\crud;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class DeleteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function delete(int $id): RedirectResponse {
        $repository = $this->entityManager->getRepository(Client::class);
        $client = $repository->find($id);

        if($client) {
            $this->entityManager->remove($client);
            $this->entityManager->flush();
            $this->addFlash("success", "Client deleted successfully");
            return $this->redirectToRoute('read');
        } else {
            $this->addFlash("error", "Client not found");
            return $this->redirectToRoute('index');
        }
    }

}