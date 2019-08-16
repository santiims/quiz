<?php


namespace Quiz\Repositories;


use Quiz\Models\QuestionModel;

class QuestionRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return QuestionModel::class;
    }

    /**
     * @param int $quizId
     * @param int $offset
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getQuestionByQuizIdAndOffset(int $quizId, int $offset)
    {
        return QuestionModel::query()->where(['quiz_id' => $quizId])->offset($offset)->first();
    }
}