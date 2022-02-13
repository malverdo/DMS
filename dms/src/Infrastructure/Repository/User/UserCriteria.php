<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\User\Contracts\UserCriteriaInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractCriteria;

class UserCriteria  extends AbstractCriteria implements UserCriteriaInterface
{

    /**
     * @var int|null
     */
    private $filterByLogin;


    /**
     * @return UserCriteriaInterface
     */
    public static function create(): UserCriteriaInterface
    {
        return new self;
    }

    /**
     * @param string|null $filterByLogin
     * @return UserCriteriaInterface
     */
    public function setFilterByLogin(?string $filterByLogin): UserCriteriaInterface
    {
        $this->filterByLogin = $filterByLogin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilterByLogin(): ?string
    {
        return $this->filterByLogin;
    }
}