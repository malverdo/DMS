<?php

namespace App\Infrastructure\Repository\User;



use App\Domain\User\Contracts\UserCollectionInterface;
use App\Domain\User\Contracts\UserEntityInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractCollection;

class UserCollection  extends AbstractCollection implements UserCollectionInterface
{
    protected function getEntityClass(): string
    {
        return UserEntityInterface::class;
    }
}