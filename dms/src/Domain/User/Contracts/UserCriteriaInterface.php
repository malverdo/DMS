<?php

namespace App\Domain\User\Contracts;


use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;

interface UserCriteriaInterface extends RepositoryCriteriaInterface
{
    /**
     * @return UserCriteriaInterface
     */
    public static function create(): UserCriteriaInterface;

    /**
     * @param string|null $filterByLogin
     * @return UserCriteriaInterface
     */
    public function setFilterByLogin(?string $filterByLogin): UserCriteriaInterface;

    /**
     * @return string|null
     */
    public function getFilterByLogin(): ?string;
}