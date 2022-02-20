<?php

namespace App\Infrastructure\ArgumentValueResolver;

use App\Infrastructure\Exception\InvalidRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoResolver implements ArgumentValueResolverInterface
{

    /**
     * @var SerializerBuilder
     */
    private $serializer;
    /**
     * @var ValidatorInterface
     */
    private $validator;



    /**
     * DtoResolver constructor.
     *
     * @param SerializerBuilder $serializer
     */
    public function __construct(SerializerBuilder $serializer,ValidatorInterface $validator)
    {
        $this->serializer = $serializer::create()->build();
        $this->validator = $validator;
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
     * @throws InvalidRequestException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $content = $request->getContent();
        if ($content) {
            $argumentObj = $this->serializer->deserialize($content, $argument->getType(), 'json');
            $violationsList = $this->validator->validate($argumentObj);

            if (\count($violationsList) > 0) {
                $message = '';
                foreach ($violationsList as $violation) {
                    $message .= ' | ' . $violation->getMessage();
                }
                throw new InvalidRequestException($message);
            }
            yield $argumentObj;
        }
        yield $request;
    }

}