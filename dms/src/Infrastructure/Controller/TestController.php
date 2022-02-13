<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\Entity\ProviderEntity;
use App\Infrastructure\Factory\ContainerFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{

    /**
     * @return Response
     * @throws \Exception
     */
    public function test(): Response
    {
        $providerService = ContainerFactory::build()->get('dms.provider.service');
//        $providerRecord = new ProviderEntity();
//        $providerRecord->setAdapter('sms');
//        $providerRecord->setCustomerId(1);
//        $providerRecord->setLogin('test');
//        $providerRecord->setPassword('password');
//        $providerRecord->setSender(('SmsC'));
//        $providerService->persist($providerRecord);

        // @Todo сделать регистрацию провайдера в таблицу provider

//        $allProvider = $providerService->getByAll();
        $allProvider = $providerService->getById(3);
        dd($allProvider);


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
