<?php

namespace App\Controller;

use App\Service\AuthService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Use esta interface



final class AuthController extends AbstractController
{

    public function __construct(
        private AuthService $accountService, 
        private JWTManager $jwtManager,
        private UserPasswordHasherInterface $passwordEncoder
        ) {}   

    #[Route('/api/createAccount', name: 'app_auth', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        try {
            $response = $this->accountService->createAccount(json_decode($request->getContent(), true));
            if (is_string($response)) {
                return $this->json(['message' => $response], 401);
            }
            
            $token = $this->jwtManager->create($response);
           
            return $this->json(['message' => 'sucesso', 'token' => $token], 200);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), 500);
        }
    }

    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request) {
        try {
            $response = $this->accountService->login(json_decode($request->getContent(), true));
            if (is_string($response)) {
                return $this->json(['message' => $response], 401);
            }
            
            $token = $this->jwtManager->create($response);
            return $this->json(['message' => 'sucesso', 'token' => $token], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json($th->getMessage(), 500);
        }
    }
}
