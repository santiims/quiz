<?php


namespace Quiz\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AnswerModel
 * @package Quiz\Models
 *
 * @property QuestionModel $question
 * @property UserAnswerModel $userAnswers
 */
class AnswerModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'answers';

    protected $fillable = ['text', 'is_correct', 'question_id'];

    /**
     * @return HasOne
     */
    public function question()
    {
        return $this->hasOne(QuestionModel::class, 'id', 'question_id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'answer_id', 'id');
    }
}