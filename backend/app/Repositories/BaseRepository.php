<?php

namespace App\Repositories;

use App\Contracts\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected readonly Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Internal query builder.
     */
    protected function query(): Builder
    {
        return $this->model->newQuery();
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    public function delete(Model $model): bool
    {
        return (bool) $model->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Read
    |--------------------------------------------------------------------------
    */

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function latest(int $limit = 20): Collection
    {
        return $this->query()
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findByUuid(string $uuid): ?Model
    {
        return $this->findBy('uuid', $uuid);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function first(): ?Model
    {
        return $this->query()->first();
    }

    public function firstOrFail(): Model
    {
        return $this->query()->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | Generic Query
    |--------------------------------------------------------------------------
    */

    public function findBy(string $column, mixed $value): ?Model
    {
        return $this->query()
            ->where($column, $value)
            ->first();
    }

    public function findAllBy(string $column, mixed $value): Collection
    {
        return $this->query()
            ->where($column, $value)
            ->get();
    }

    public function existsBy(string $column, mixed $value): bool
    {
        return $this->query()
            ->where($column, $value)
            ->exists();
    }

    public function count(): int
    {
        return $this->model->count();
    }

    public function countBy(string $column, mixed $value): int
    {
        return $this->query()
            ->where($column, $value)
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    protected function searchQuery(
        array $columns,
        string $keyword
    ): Builder {

        return $this->query()
            ->where(function ($query) use ($columns, $keyword) {

                foreach ($columns as $column) {

                    $query->orWhere(
                        $column,
                        'LIKE',
                        "%{$keyword}%"
                    );

                }

            });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter
    |--------------------------------------------------------------------------
    */

    protected function filterQuery(
        array $filters
    ): Builder {

        $query = $this->query();

        foreach ($filters as $column => $value) {

            if ($value === null || $value === '') {
                continue;
            }

            $query->where($column, $value);

        }

        return $query;

    }
}