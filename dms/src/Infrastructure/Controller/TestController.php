<?php

namespace App\Infrastructure\Controller;

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
        $smsMessageService = ContainerFactory::build()->get('dms.provider.service');

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
