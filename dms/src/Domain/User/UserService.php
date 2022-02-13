<?php

namespace App\Domain\User;

use App\Domain\Provider\Contracts\ProviderRepositoryInterface;
use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Domain\User\Contracts\UserRepositoryInterface;
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
     * @return UserRepositoryInterface
     */
    public function getUserByLogin(string $login): UserRepositoryInterface
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
     * @param ProviderEntityInterface $providerEntity
     * @return void
     */
    public function persist(ProviderEntityInterface $providerEntity): void
    {
        try {
            $this->providerRepository->save($providerEntity);
        } catch (RepositoryException $ex) {
            throw new RepositoryException($ex);
        }
    }


    /**
     * @param int $id
     * @return ProviderEntityInterface
     */
    public function getById(int $id): ProviderEntityInterface
    {
        $providers = $this->providerRepository->findById(
            ProviderCriteria::create()->setFilterById($id)
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
     *
     * @return array
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function getByAll(): array
    {
        $providers = $this->userRepository->findByAllCriteria(
            UserCriteria::create()
        );

        if (!$providers->count()) {
            throw new ProviderException('providers not found');
        }

        return $providers->getEntities();
    }
}