<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function register(Request $request): Response
    {
        return new Response('test');
    }
}
