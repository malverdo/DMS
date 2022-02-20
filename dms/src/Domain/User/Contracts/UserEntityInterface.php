<?php

namespace App\Domain\User\Contracts;


interface UserEntityInterface
{

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getRoles(): string;


    /**
     * @return string
     */
    public function getPassword(): ?string;

}