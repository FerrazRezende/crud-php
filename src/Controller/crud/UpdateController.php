<?php

namespace App\Controller\crud;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

class UpdateController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(Request $request, $id): RedirectResponse
    {

        if ($request->getMethod() == 'POST') {
            $client = $this->entityManager->getRepository(Client::class)->find($id);

            $client->setFirstName($request->request->get('first-name'));
            $client->setLastName($request->request->get('last-name'));
            $client->setEmail($request->request->get('email'));

            $this->entityManager->flush();

            $this->addFlash("success", "Client updated successfully!");

            return $this->redirectToRoute('index');
        }

        return $this->redirectToRoute('index');
    }
}