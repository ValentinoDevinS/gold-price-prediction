<?php

namespace App\Repositories;

use App\Contracts\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    /*
    |--------------------------------------------------------------------------
    | Defaults
    |--------------------------------------------------------------------------
    */

    protected const DEFAULT_PER_PAGE = 20;

    protected const MAX_PER_PAGE = 100;

    protected const DEFAULT_SORT = 'created_at';

    protected const DEFAULT_DIRECTION = 'desc';

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    */

    protected array $searchable = [];

    protected array $filterable = [];

    protected array $sortable = [];

    /*
    |--------------------------------------------------------------------------
    | Repository Defaults
    |--------------------------------------------------------------------------
    */

    protected string $defaultSort = self::DEFAULT_SORT;

    protected string $defaultDirection = self::DEFAULT_DIRECTION;

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
            ->latest($this->defaultSort)
            ->limit($limit)
            ->get();
    }

    public function paginate(
        int $perPage = self::DEFAULT_PER_PAGE
    ): LengthAwarePaginator{

        $perPage = $this->sanitizePerPage($perPage);
        return $this->query()
            ->latest($this->defaultSort)
            ->paginate();
    }

    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Find a model by UUID.
     */

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

    protected function applySearch(
        Builder $query,
        ?string $keyword
    ): Builder
    {
        $keyword = trim((string) $keyword);

        if (
            $keyword === '' ||
            empty($this->searchable)
        ) {
            return $query;
        }

        return $query->where(function (
            Builder $builder
        ) use ($keyword) {

            foreach ($this->searchable as $column) {

                $builder->orWhere(
                    $column,
                    'LIKE',
                    "%{$keyword}%"
                );

            }

        });
    }

    public function findOrFailByUuid(
        string $uuid
    ): Model
    {
        return $this->query()

            ->where(
                'uuid',
                $uuid
            )

            ->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | Filter
    |--------------------------------------------------------------------------
    */

    protected function applyFilters(
        Builder $query,
        array $filters
    ): Builder
    {
        foreach ($filters as $column => $value) {

            if ($value === null || $value === '') {
                continue;
            }

            if (! in_array(
                $column,
                $this->filterable,
                true
            )) {
                continue;
            }

            if (is_array($value)) {

                $query->whereIn(
                    $column,
                    $value
                );

                continue;

            }

            $query->where(
                $column,
                $value
            );

        }

        return $query;
    }

    protected function applySorting(
        Builder $query,
        ?string $sort,
        ?string $direction
    ): Builder
    {
        $sort ??= $this->defaultSort;

        $direction ??= $this->defaultDirection; 

        if (
            ! in_array(
                $sort,
                $this->sortable,
                true
            )
        ) {

            $sort = $this->defaultSort;

        }

        if (
            ! in_array(
                strtolower($direction),
                ['asc', 'desc'],
                true
            )
        ) {

            $direction = $this->defaultDirection;

        }

        return $query->orderBy(
            $sort,
            $direction
        );
    }

    protected function sanitizePerPage(
        int $perPage
    ): int
    {
        return max(
            1,
            min(
                $perPage,
                self::MAX_PER_PAGE
            )
        );
    }

    public function queryList(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null
    ): Builder
    {
        $query = $this->query();

        $query = $this->applySearch(
            $query,
            $search
        );

        $query = $this->applyFilters(
            $query,
            $filters
        );

        return $this->applySorting(
            $query,
            $sort,
            $direction
        );
    }

    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = self::DEFAULT_SORT,
        ?string $direction = self::DEFAULT_DIRECTION,
        int $perPage = self::DEFAULT_PER_PAGE
    ): LengthAwarePaginator
    {
        $perPage = $this->sanitizePerPage(
            $perPage
        );

        return $this->queryList(
            $filters,
            $search,
            $sort,
            $direction
        )->paginate($perPage);
    }

    public function exists(
        array $conditions
    ): bool
    {
        if (empty($conditions)) {
            return false;
        }
        
        $query = $this->query();

        foreach (
            $conditions as
            $column => $value
        ) {

            $query->where(
                $column,
                $value
            );

        }

        return $query->exists();
    }
}