<?php

namespace App\Domain\Provider\Contracts;


use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;

/**
 * Interface ProviderCriteriaInterface
 * @package App\Domain\Provider\Contracts
 */
interface ProviderCriteriaInterface extends RepositoryCriteriaInterface
{
    /**
     * @return ProviderCriteriaInterface
     */
    public static function create(): ProviderCriteriaInterface;

    /**
     * @param int|null $filterByCustomerId
     * @return ProviderCriteriaInterface
     */
    public function setFilterByCustomerId(?int $filterByCustomerId): ProviderCriteriaInterface;

    /**
     * @return int|null
     */
    public function getFilterByCustomerId(): ?int;
}