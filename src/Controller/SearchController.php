<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class SearchController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function search(Request $request): Response
    {
        if ($request->isMethod('POST'))
        {

            $searchTerm = $request->get('search');

            $repository = $this->entityManager->getRepository(Client::class);

            $query = $repository->createQueryBuilder('c')
                ->where('c.firstName LIKE :searchTerm 
                                    OR c.lastName LIKE :searchTerm 
                                    OR c.email LIKE :searchTerm
                        ')
                ->setParameter('searchTerm', '%' . $searchTerm . '%')
                ->getQuery();



            $results = $query->getResult();

            if($results == null) {
                $this->addFlash('error', 'Nenhum resultado encontrado');
                return $this->redirectToRoute('index');
            }

        }

        return $this->render('search.html.twig', [
            'results' => $results
        ]);
    }












}