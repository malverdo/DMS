<?php

namespace App\Infrastructure\Repository\BaseRepository;


use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;

/**
 * Class AbstractCriteria
 * @package App\Infrastructure\Repository\BaseRepository
 */
abstract class AbstractCriteria implements RepositoryCriteriaInterface
{

    /**
     * @var string|null
     */
    protected $filterById;

    /**
     * @var int|null
     */
    protected $pageSize;

    /**
     * @var int|null
     */
    protected $offset;

    /**
     * DESC|ASC
     * @var string|null
     */
    protected $sortById;

    /**
     * @return string|null
     */
    public function getSortById(): ?string
    {
        return $this->sortById;
    }


    /**
     * @return string|null
     */
    public function getFilterById(): ?string
    {
        return $this->filterById;
    }


    /**
     * @return int|null
     */
    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @param string|null $orderById
     * @return RepositoryCriteriaInterface
     */
    public function setSortById(?string $orderById): RepositoryCriteriaInterface
    {
        $this->sortById = $orderById;
        return $this;
    }

    /**
     * @param int|null $offset
     * @return RepositoryCriteriaInterface
     */
    public function setOffset(?int $offset): RepositoryCriteriaInterface
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param string|null $id
     * @return RepositoryCriteriaInterface
     */
    public function setFilterById(?string $id): RepositoryCriteriaInterface
    {
        $this->filterById = $id;
        return $this;
    }

    /**
     * @param int|null $size
     * @return RepositoryCriteriaInterface
     */
    public function setPageSize(?int $size): RepositoryCriteriaInterface
    {
        $this->pageSize = $size;
        return $this;
    }
}