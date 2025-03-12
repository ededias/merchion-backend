<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService {
    
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordEncoder
    ){}

    public function createAccount($payload): object|string    {
        try {
            
            $user = $this->userRepository->findOneBy(['email' => $payload['email']]);
            if ($user) {
                return 'Usuário já cadastrado';
            }


            $user = new User();
            $user->setName($payload['name']);
            $user->setEmail($payload['email']);
            $hashedPassword = $this->passwordEncoder->hashPassword($user, $payload['password']);
            $user->setPassword($hashedPassword);
            return $this->userRepository->save($user);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function login($payload): object|string    {
        try {
            $user = $this->userRepository->findOneBy(['email' => $payload['email']]);
            if (!$user) {
                return 'Usuário não encontrado';
            }
            if ($this->passwordEncoder->isPasswordValid($user, $payload['password'])) {
                return $user;
            }
            return 'Senha inválida';
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}