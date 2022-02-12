<?php

namespace App\Domain\Provider;

use App\Domain\Provider\Contracts\ProviderRepositoryInterface;
use App\Domain\Provider\Contracts\SenderInterface;
use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Domain\Provider\Exceptions\ProviderException;
use App\Infrastructure\Repository\Provider\ProviderCriteria;

class ProviderService
{

    private $providerRepository;

    /**
     * @param ProviderRepositoryInterface $providerRepository
     */
    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * @param int $customerId
     * @return SenderInterface[]
     */
    public function getSenderListByCustomerId(int $customerId): array
    {
        $providers = $this->providerRepository->findByCriteria(
            ProviderCriteria::create()->setFilterByCustomerId($customerId)
        );
        $result = [];
        foreach ($providers as $provider) {
            $result = array_merge($result,$provider->getSender());
        }
        return $result;
    }

    /**
     * @param int $customerId
     * @return ProviderEntityInterface
     */
    public function getProviderByByCustomerId(int $customerId): ProviderEntityInterface
    {
        $providers = $this->providerRepository->findByCriteria(
            ProviderCriteria::create()->setFilterByCustomerId($customerId)
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
//        try {
            $this->providerRepository->save($providerEntity);
//        } catch (RepositoryException $ex) {
//            throw new SmsMessageException($ex);
//        }
    }
}