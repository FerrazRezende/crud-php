<?php
namespace App\Controller\crud;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Entity\Client;

class ReadController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function read(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit= 10;
        $offset = ($page - 1) * $limit;

        $repository = $this->entityManager->getRepository(Client::class);

        $query = $repository->createQueryBuilder('c')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();

        $paginator = new Paginator($query);



        return $this->render('crud/read.html.twig', [
            'paginator' => $paginator
        ]);
    }
}

