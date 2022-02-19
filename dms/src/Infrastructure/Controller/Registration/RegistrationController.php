<?php

namespace App\Infrastructure\Controller\Registration;

use App\Infrastructure\Factory\ContainerFactory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController  extends AbstractController
{


    /**
     * @param Request $request
     * @return Response
     */
    public function registration(
        Request $request
    ): Response {
        $content = $request->getContent();


        return $this->json([
            'message' => 'Welcome to your new RegistrationController!'
        ]);
    }
}