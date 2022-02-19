<?php

namespace App\Infrastructure\Controller\Registration;

use App\Domain\Dto\RegistrationRequest;
use App\Infrastructure\Factory\ContainerFactory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController  extends AbstractController
{


    /**
     * @param RegistrationRequest $registrationRequest
     * @return Response
     */
    public function registration(
        RegistrationRequest $registrationRequest
    ): Response {
        $content = $registrationRequest;


        return $this->json([
            'message' => 'Welcome to your new RegistrationController!'
        ]);
    }
}