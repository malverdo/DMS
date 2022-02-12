<?php

namespace App\Domain\Provider\Contracts;


interface ProviderEntityInterface
{

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getLogin();

    /**
     * @return string
     */
    public function getPassword();


    /**
     * @return string
     */
    public function getAdapter();

    /**
     * @return mixed
     */
    public function getAdapterInstance();

    /**
     * @return SenderInterface[]
     */
    public function getSender();

}