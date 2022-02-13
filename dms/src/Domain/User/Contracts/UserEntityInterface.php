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
     * @return array
     */
    public function getRoles(): array;


    /**
     * @return string
     */
    public function getPassword(): ?string;

}