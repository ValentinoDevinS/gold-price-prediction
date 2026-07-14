<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    public function create(array $data): Model;

    public function update(Model $model, array $data): bool;

    public function delete(Model $model): bool;

    /*
    |--------------------------------------------------------------------------
    | Read
    |--------------------------------------------------------------------------
    */

    public function all(): Collection;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function latest(int $limit = 20): Collection;

    public function findById(int $id): ?Model;

    public function findByUuid(string $uuid): ?Model;

    public function findOrFail(int $id): Model;

    public function first(): ?Model;

    public function firstOrFail(): Model;

    /*
    |--------------------------------------------------------------------------
    | Generic
    |--------------------------------------------------------------------------
    */

    public function findBy(string $column, mixed $value): ?Model;

    public function findAllBy(string $column, mixed $value): Collection;

    public function existsBy(string $column, mixed $value): bool;

    public function count(): int;

    public function countBy(string $column, mixed $value): int;
}