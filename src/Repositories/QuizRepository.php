<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Model;
use Quiz\Models\QuizModel;

/**
 * Class QuizRepository
 * @package Quiz\Repositories
 * @method QuizModel one(array $conditions = []) : ?Model
 */
class QuizRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return QuizModel::class;
    }
}