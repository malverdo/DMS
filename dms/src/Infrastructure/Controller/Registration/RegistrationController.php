<?php

namespace App\Infrastructure\Controller\Registration;

use App\Domain\Dto\RegistrationRequest;
use App\Domain\User\Contracts\UserEntityInterface;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Factory\ContainerFactory;

use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

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