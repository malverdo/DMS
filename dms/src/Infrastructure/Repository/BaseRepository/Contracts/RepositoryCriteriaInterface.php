<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


/**
 * Class RepositoryCriteriaInterface
 * @package App\Infrastructure\Repository\BaseRepository\Contracts
 */
interface RepositoryCriteriaInterface
{
    /**
     * @return string|null
     */
    public function getFilterById(): ?string;

    /**
     * @param string|null $id
     * @return RepositoryCriteriaInterface
     */
    public function setFilterById(?string $id): RepositoryCriteriaInterface;

    /**
     * @return int|null
     */
    public function getPageSize(): ?int;

    /**
     * @return int|null
     */
    public function getOffset(): ?int;

    /**
     * @return string|null
     */
    public function getSortById(): ?string;

    /**
     * @param int|null $size
     * @return RepositoryCriteriaInterface
     */
    public function setPageSize(?int $size): RepositoryCriteriaInterface;

}