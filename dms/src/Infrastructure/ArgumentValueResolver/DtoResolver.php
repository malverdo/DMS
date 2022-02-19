<?php

namespace App\Infrastructure\ArgumentValueResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;


class DtoResolver implements ArgumentValueResolverInterface
{

    /**
     * @var SerializerInterface
     */
    private $jsonSerializer;

    /**
     * DtoResolver constructor.
     *
     * @param SerializerInterface $serializer
     * @param SerializerInterface $jsonSerializer
     */
    public function __construct( SerializerInterface $jsonSerializer)
    {
        $this->jsonSerializer = $jsonSerializer;
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
        $argumentObj = $this->jsonSerializer->deserialize($content, $argument->getType(), 'json');


        yield $argumentObj;

    }

}