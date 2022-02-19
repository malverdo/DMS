<?php

namespace App\Domain\Dto;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedName;

class RegistrationRequest
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
}