<?php


namespace Quiz\Models;

/**
 * Class AttemptModel
 * @package Quiz\Models
 * @property int $id
 * @property int $user_id
 * @property int $quiz_id
 *
 * @property UserModel $user
 * @property QuizModel $quiz
 * @property UserAnswerModel[] $userAnswers
 */
class AttemptModel extends BaseModel
{
    protected $table = 'attempts';

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    public function quiz()
    {
        return $this->hasOne(QuizModel::class, 'id', 'quiz_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'attempt_id', 'id');
    }
}