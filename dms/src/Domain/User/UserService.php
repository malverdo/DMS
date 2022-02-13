<?php

namespace App\Domain\User;

use App\Domain\Provider\Contracts\ProviderRepositoryInterface;
use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Domain\User\Contracts\UserEntityInterface;
use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Repository\User\UserCriteria;


class UserService
{

    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    /**
     * @param string $login
     * @return UserEntityInterface
     */
    public function getUserByLogin(string $login): UserEntityInterface
    {
        $providers = $this->userRepository->findByCriteria(
            UserCriteria::create()->setFilterByLogin($login)
        );

        if (!$providers->count()) {
            throw new ProviderException('providers not found');
        }

        if ($providers->count() > 1) {
            throw new ProviderException('providers more 1');
        }

        return $providers->current();
    }


    /**
     * @param  UserEntityInterface $providerEntity
     * @return void
     */
    public function persist(UserEntityInterface $providerEntity): void
    {
        try {
            $this->userRepository->save($providerEntity);
        } catch (RepositoryException $ex) {
            throw new RepositoryException($ex);
        }
    }


}