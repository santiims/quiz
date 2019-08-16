<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Model;
use Quiz\Models\AttemptModel;

/**
 * Class AttemptRepository
 * @package Quiz\Repositories
 *
 * @method AttemptModel create(array $data) : Model
 * @method AttemptModel|null one(array $conditions = []) : ?Model
 */
class AttemptRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return AttemptModel::class;
    }
}