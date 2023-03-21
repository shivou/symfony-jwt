<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api', name: 'api_security_')]
class SecurityController extends AbstractController
{

    #[Route('/register', name: 'register', methods: ["POST"])]
    public function register(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent());
  
        $user = new User();
        $user->setEmail($data->email);
        $user->setUsername($data->username);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data->password
        );
        $user->setPassword($hashedPassword);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
  
        return $this->json(['message' => 'Registered successfully']);
    }

}
