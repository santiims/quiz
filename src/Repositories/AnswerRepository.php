<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Model;
use Quiz\Models\AnswerModel;

/**
 * Class AnswerRepository
 * @package Quiz\Repositories
 *
 * @method AnswerModel|null one(array $conditions = []) : ?Model
 */
class AnswerRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return AnswerModel::class;
    }
}