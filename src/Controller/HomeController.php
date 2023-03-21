<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: 'api_')]
class HomeController extends AbstractController
{

    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(Security $security): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome '.$security->getUser()->getUsername()
        ]);
    }
    
}
