<?php
namespace App\Controller\crud;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadController extends AbstractController
{
    public function read(): Response
    {
        return $this->render('crud/read.html.twig');
    }
}

