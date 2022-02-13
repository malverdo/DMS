<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\Entity\ProviderEntity;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Factory\ContainerFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestController extends AbstractController
{

    /**
     * @return Response
     * @throws \Exception
     */
    public function test(UserPasswordHasherInterface $passwordHasher): Response
    {
//        $providerService = ContainerFactory::build()->get('dms.provider.service');

//        $providerRecord = new ProviderEntity();
//        $providerRecord->setAdapter('sms');
//        $providerRecord->setCustomerId(1);
//        $providerRecord->setLogin('test');
//        $providerRecord->setPassword('password');
//        $providerRecord->setSender(('SmsC'));
//        $providerService->persist($providerRecord);

        // @Todo сделать регистрацию провайдера в таблицу provider

//        $allProvider = $providerService->getByAll();
//        $allProvider = $providerService->getById(3);






//        $userRecord = new User();
//        $userRecord->setLogin('malverdo');
//        $userRecord->setRoles(["ADMIN","MODER"]);
//        $hashedPassword = $passwordHasher->hashPassword(
//            $userRecord,
//            'malverdo'
//        );
//
//        $userRecord->setPassword($hashedPassword);
//        $userRecord->setNew(true);

        $userService = ContainerFactory::build()->get('dms.user.service');
        $a = $userService->getUserByLogin('malverdo');
        $b = $a->getRoles();

        if ($passwordHasher->isPasswordValid($a, 'malverdo')) {
            dd($a->getPassword());
        }
//         $userService->persist($a);



        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
