<?php

namespace App\Infrastructure\Repository\Provider;

use App\Domain\Provider\Contracts\ProviderCriteriaInterface;
use App\Infrastructure\Repository\BaseRepository\AbstractCriteria;

/**
 * Class SmsMessageCriteria
 * @package App\Infrastructure\Repository\SmsMessage
 */
class ProviderCriteria extends AbstractCriteria implements ProviderCriteriaInterface
{
    /**
     * @var int|null
     */
    private $filterByCustomerId;

    /**
     * @return int|null
     */
    public function getFilterByCustomerId(): ?int
    {
        return $this->filterByCustomerId;
    }

    /**
     * @param int|null $filterByCustomerId
     * @return ProviderCriteria
     */
    public function setFilterByCustomerId(?int $filterByCustomerId): ProviderCriteriaInterface
    {
        $this->filterByCustomerId = $filterByCustomerId;
        return $this;
    }

    /**
     * @return ProviderCriteriaInterface
     */
    public static function create(): ProviderCriteriaInterface
    {
        return new self;
    }
}