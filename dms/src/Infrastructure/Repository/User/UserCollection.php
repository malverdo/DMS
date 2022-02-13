<?php

namespace App\Infrastructure\Repository\User;



use App\Domain\User\Contracts\UserCollectionInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCollection  extends AbstractCollection implements UserCollectionInterface
{
    protected function getEntityClass(): string
    {
        return UserInterface::class;
    }
}