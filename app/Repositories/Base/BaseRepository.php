<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    // ss
    /**
     * @param  array  $columns
     * @param  array  $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @param  array  $columns
     * @param  array  $relations
     * @return Collection
     */
    public function allActive(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->where('status', 'active')->with($relations)->get($columns);
    }

    /**
     * Method limit
     *
     * @param int $limit [limit]
     * @param array $columns [required columns]
     * @param array $relations [required relations]
     *
     * @return Collection
     */
    public function limit(int $limit, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->limit($limit)->get($columns);
    }

    /**
     * Method paginate
     *
     * @param  int  $number [number of records per page]
     * @return
     */
    public function paginate(int $number)
    {
        return $this->model->paginate($number);
    }

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

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
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }
    /**
     * Find model by id.
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Model
     */
    public function findByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->where($paramsAnddData)->first();
    }

    /**
     * Find model by id.
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Model
     */
    public function findLastByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->where($paramsAnddData)->last();
    }

    /**
     * Find models by column using whereIn clause.
     *
     * @param  string  $column
     * @param  array   $values
     * @param  array   $columns
     * @param  array   $relations
     * @return Collection
     */
    public function findWhereIn(
        string $column,
        array $values,
        array $columns = ['*'],
        array $relations = []
    ): Collection {
        return $this->model
            ->select($columns)
            ->with($relations)
            ->whereIn($column, $values)
            ->get();
    }

    /**
     * Find model by columns.
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Collection
     */
    public function getByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = [],
        string $orderBy = 'id',
        string $orderDirection = 'desc'
    ): ?Collection {
        return $this->model->select($columns)->with($relations)->where($paramsAnddData)->orderBy($orderBy, $orderDirection)->get();
    }

    /**
     * getByQuery
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Collection
     */
    public function getByQuery(
        array $paramsAndData,
        array $columns = ['*'],
        array $relations = [],
        string $orderBy = 'id',
        string $orderDirection = 'desc'
    ): ?Collection {
        return $this->model->select($columns)->with($relations)->where($paramsAndData)->orderBy($orderBy, $orderDirection)->get();
    }

    /**
     * getRandom
     *
     * @return void
     */
    public function getRandom(
        Int $limit,
        array $idNotIn,
        array $columns = ['*'],
        array $relations = []
    ) {
        return $this->model->select($columns)->with($relations)->whereNotIn('id', $idNotIn)->inRandomOrder()->limit($limit)->get();
    }

    /**
     * updateByColumn
     *
     * @return void
     */
    public function updateByColumn(
        array $conditions,
        array $updateData
    ): int {
        return $this->model->where($conditions)->update($updateData);
    }
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
    ): ?Bool {
        return $this->model->select($columns)->where($paramsAnddData)->exists();
    }

    /**
     * Find trashed model by id.
     *
     * @param  int  $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    public function findByIdWithoutRelation(int $modelId): ?Model
    {
        return $this->model->findOrFail($modelId);
    }

    /**
     * Find only trashed model by id.
     *
     * @param  int  $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * Create a model.
     *
     * @param  array  $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        return $this->model->create($payload);
    }

    /**
     * Method createMany
     *
     * @param  array  $payloadCollection [collection of payload]
     * @return Collection
     */
    public function createMany(array $payloadCollection): ?Collection
    {
        return $this->model->createMany($payloadCollection);
    }

    /**
     * updateOrCreate
     *
     * @param  mixed $conditions
     * @param  mixed $data
     * @return void
     */
    public function updateOrCreate(array $conditions, array $data): ?Model
    {
        return $this->model->updateOrCreate($conditions, $data);
    }

    /**
     * Update existing model.
     *
     * @param  int  $modelId
     * @param  array  $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }
    /**
     * @param int $modelId
     * @param array $payload
     *
     * @return bool
     */
    public function updateWithTrashed(int $modelId, array $payload): bool
    {
        $model = $this->findTrashedById($modelId);

        return $model->update($payload);
    }

    /**
     * Delete model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }
    /**
     * Method deleteByColumn
     *
     * @param array $params [explicite description]
     *
     * @return bool
     */
    public function deleteByColumn(array $params): bool
    {
        return $this->model->where($params)->delete();
    }

    /**
     * Restore model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool
    {
        return $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * Permanently delete model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool
    {
        return $this->findTrashedById($modelId)->forceDelete();
    }

    /**
     * Method permanentlyDeleteByColumn
     *
     * @param array $params [explicite description]
     *
     * @return bool
     */
    public function permanentlyDeleteByColumn(array $params): bool
    {
        return $this->model->where($params)->forceDelete();
    }
    /**
     * Method filter
     *
     * @param array $request [Http Request]
     * @param array $with [Relations]
     *
     * @return LengthAwarePaginator
     */
    public function filter($filters, $with = []): LengthAwarePaginator
    {
        $query = $this->model->filter($filters)->orderByColumn($filters['sortBy'], $filters['sortDirection']);
        if (count($with) > 0) {
            $query = $query->with($with);
        }
        return $query->paginate($filters['rowPerPage'])->appends($filters);
    }
}
