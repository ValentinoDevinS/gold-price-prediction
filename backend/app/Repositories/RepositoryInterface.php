<?php

namespace App\Contracts\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(): Collection;

    public function latest(int $limit = 20): Collection;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Model;

    public function update(Model $model, array $data): bool;

    public function delete(Model $model): bool;

    public function findById(int $id): ?Model;

    public function findByUuid(string $uuid): ?Model;

    public function findOrFail(int $id): Model;

    public function first(): ?Model;

    public function firstOrFail(): Model;

    public function findBy(string $column, mixed $value): ?Model;

    public function findAllBy(string $column, mixed $value): Collection;

    public function existsBy(string $column, mixed $value): bool;

    public function count(): int;

    public function countBy(string $column, mixed $value): int;
}