<?php

namespace App\Controller\crud;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class CreateController extends AbstractController
{
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $client = new Client();
            $client->setFirstName($request->get('firstname'));
            $client->setLastName($request->get('lastname'));
            $client->setEmail($request->get('email'));

            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('index');

        }
        return $this->render('crud/create.html.twig');
    }
}