<?php

namespace App\Controller\crud;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CreateController extends AbstractController
{
    private $csrfTokenManager;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function create(Request $request, EntityManagerInterface $em): Response
    {

        $token = $this->csrfTokenManager->getToken('token_id')->getValue();

        if ($request->isMethod('POST')) {

            $submittedToken = $request->get('csrf_token');
            if(!$this->csrfTokenManager->isTokenValid(new CsrfToken('token_id', $submittedToken))) {
                throw $this->createNotFoundException('CSRF token is invalid.');
            }

            $client = new Client();
            $client->setFirstName($request->get('firstname'));
            $client->setLastName($request->get('lastname'));
            $client->setEmail($request->get('email'));

            $em->persist($client);
            $em->flush();

            $this->addFlash('success', 'Cliente criado com sucesso!');

            return $this->redirectToRoute('index');

        }
        return $this->render('crud/create.html.twig', [
            'csrf_token' => $token,
        ]);
    }
}