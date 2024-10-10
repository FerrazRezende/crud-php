<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Comment;
use App\Entity\Client;

class CommentController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createComments(Request $request, $clientId): Response
    {
        $data = $request->get('comment');

        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if (!$client) {
            $this->addFlash('error', 'Client not found!');
            throw $this->createNotFoundException(
                'No cliente found'
            );
        }

        $comment = new Comment();
        $comment->setContent($data);
        $comment->setCreatedAt(new \DateTime());
        $comment->setClient($client);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        $this->addFlash('success', 'Comment created successfully!');
        return $this->redirectToRoute('readOne', ['id' => $clientId]);

    }

    public function readComments($clientId): Response
    {
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if (!$client) {
            $this->addFlash('error', 'Client not found!');
            throw $this->createNotFoundException(
                'No cliente found'
            );
        }

        $comments = $client->getComments();

        return $this->redirectToRoute('readOne', [
            'client' => $client,
            'comments' => $comments
        ]);

    }

    public function deleteComments($clientId, $commentId): Response
    {
        $comment = $this->entityManager
            ->getRepository(Comment::class)
            ->findOneBy([
                'id' => $commentId,
                'Client' => $clientId
            ]);

        if ($comment) {
            $this->entityManager->remove($comment);
            $this->entityManager->flush();

        }

        return $this->redirectToRoute('readOne', ['id' => $clientId]);

    }

}