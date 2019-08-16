<?php


namespace Quiz\Repositories;


use Quiz\Models\UserAnswerModel;

class UserAnswerRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return UserAnswerModel::class;
    }
}