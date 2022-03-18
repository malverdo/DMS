<?php

namespace App\Domain\Dto;


use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class TestRequest
{
    /**
     * @SerializedName("login")
     * @Type("string")
     * @var string
     */
    public $login;

    /**
     * @SerializedName("password")
     * @Type("string")
     * @var string
     */
    public $password;


    public function validate(ExecutionContextInterface $context, $payload)
    {

        if (count((array) $context->getObject()) > 2) {
            $context->buildViolation('в path registration должен быть JSON с полями - login, password')
                ->addViolation();
        }


    }
}