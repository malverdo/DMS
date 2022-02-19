<?php

namespace App\Infrastructure\ArgumentValueResolver;

use App\Infrastructure\Factory\ContainerFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use JMS\Serializer\SerializerBuilder;


class DtoResolver implements ArgumentValueResolverInterface
{

    /**
     * @var SerializerBuilder
     */
    private $serializer;

    /**
     * DtoResolver constructor.
     *
     * @param SerializerBuilder $serializer
     */
    public function __construct(SerializerBuilder $serializer)
    {
        $this->serializer = $serializer::create()->build();
    }


    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return bool
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return class_exists($argument->getType());
    }

    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return \Generator
     */
    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $content = $request->getContent();
        $argumentObj = $this->serializer->deserialize($content, $argument->getType(), 'json');


        yield $argumentObj;

    }

}