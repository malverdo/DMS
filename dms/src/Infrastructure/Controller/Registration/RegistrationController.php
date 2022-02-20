<?php

namespace App\Infrastructure\Controller\Registration;

use App\Domain\Dto\RegistrationRequest;

use App\Domain\User\UserService;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Factory\ContainerFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController  extends AbstractController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var User
     */
    private $user;

    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->userService = ContainerFactory::build()->get('dms.user.service');
        $this->user = ContainerFactory::build()->get('dms.user');;
        $this->passwordHasher = $passwordHasher;
    }


    /**
     * @param RegistrationRequest $registrationRequest
     * @return Response
     */
    public function registration(
        RegistrationRequest $registrationRequest
    ): Response {

        $this->user->setLogin($registrationRequest->login);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $this->user,
            $registrationRequest->password
        );
        $this->user->setRoles(["ADMIN",'MODER']);
        $this->user->setPassword($hashedPassword);
        $this->userService->persist($this->user);


        return $this->json([
            'message' => 'Welcome to your new RegistrationController!'
        ]);
    }
}