<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class BaseEloquentRepository extends BaseRepository
{
    /**
     * @throws RepositoryException
     */
    public function getTableName(): string
    {
        return $this->makeModel()->getTable();
    }

    /**
     * @throws RepositoryException
     */
    public function getKeyName(): string
    {
        return $this->makeModel()->getKeyName();
    }

    public function getColumnName(string $column, string $as = null): string
    {
        $column = $this->getTableName() . '.' . $column;

        return $as ? "$column as $as" : $column;
    }
}
