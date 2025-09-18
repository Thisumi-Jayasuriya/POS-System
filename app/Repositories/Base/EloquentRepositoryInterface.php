<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     *
     * @param  array  $columns
     * @param  array  $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Get all active models.
     *
     * @param  array  $columns
     * @param  array  $relations
     * @return Collection
     */
    public function allActive(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection;

    /**
     * Find model by id.
     *
     * @param  int  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Model
     */
    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    public function findByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    public function findLastByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    public function getByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = [],
        string $orderBy = 'id',
        string $orderDirection = 'desc'
    ): ?Collection;

    public function getByQuery(
        array $paramsAndData,
        array $columns = ['*'],
        array $relations = [],
        string $orderBy = 'id',
        string $orderDirection = 'desc'
    ): ?Collection;

    public function findWhereIn(
        string $column,
        array $values,
        array $columns = ['*'],
        array $relations = []
    ): ?Collection;
    /**
     * Find trashed model by id.
     *
     * @param  int  $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model;

    /**
     * Find only trashed model by id.
     *
     * @param  int  $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model;

    /**
     * Create a model.
     *
     * @param  array  $payload
     * @return Model
     */
    public function create(array $payload): ?Model;

    /**
     * updateOrCreate
     *
     * @param  mixed $conditions
     * @param  mixed $data
     * @return void
     */
    public function updateOrCreate(array $conditions, array $data): ?Model;
    /**
     * Update existing model.
     *
     * @param  int  $modelId
     * @param  array  $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool;

    /**
     * @param int $modelId
     * @param array $payload
     *
     * @return bool
     */
    public function updateWithTrashed(int $modelId, array $payload): bool;
    /**
     * Delete model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * Delete models by column conditions.
     *
     * @param array $params
     * @return bool
     */
    public function deleteByColumn(array $params): bool;

    /**
     * Restore model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool;

    /**
     * Permanently delete model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool;

    /**
     * @param mixed $filters
     * @param mixed $with=[]
     *
     * @return LengthAwarePaginator
     */
    public function filter($filters, $with = []): LengthAwarePaginator;

    /**
     * updateByColumn
     *
     * @return void
     */
    public function updateByColumn(
        array $conditions,
        array $updateData
    ): int;

    /**
     * Find model by existsByColumn.
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @return Boolean
     */
    public function existsByColumn(
        array $paramsAnddData,
        array $columns = ['*']
    ): ?Bool;
}
