<?php

namespace App\Infrastructure\Repository\Provider;


use App\Domain\Provider\Contracts\ProviderCollectionInterface;
use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractCollection;

/**
 * Class ProviderCollection
 * @package App\Infrastructure\Repository\Provider
 */
class ProviderCollection extends AbstractCollection implements ProviderCollectionInterface
{
    protected function getEntityClass(): string
    {
        return ProviderEntityInterface::class;
    }
}