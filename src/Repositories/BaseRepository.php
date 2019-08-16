<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected abstract function getModelClass();

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function one(array $conditions = []): ?Model
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $model = $className::query()->where($conditions)->first();

        return $model;
    }

    /**
     * @param array $conditions
     * @return Collection|null
     */
    public function all(array $conditions = []): ?Collection
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $models = $className::query()->where($conditions)->get();

        return $models;
    }

    public function count(array $conditions = [])
    {
        $className = $this->getModelClass();

        $count = $className::query()->where($conditions)->count();

        return $count;
    }

    public function exists(array $conditions = [])
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $rowExists = $className::query()->where($conditions)->exists();

        return $rowExists;
    }

    public function create(array $data): Model
    {
        /** @var Model $className */
        $className = $this->getModelClass();
        /** @var Model $model */
        $model = new $className;
        $model->fill($data);
        $model->save();

        return $model;
    }
}