<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class QuestionModel
 * @package Quiz\Models
 * @property int $id
 * @property string $text
 * @property int $quiz_id
 *
 * @property QuizModel $quiz
 */
class QuestionModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'questions';

    protected $fillable = ['text', 'quiz_id'];

    /**
     * @return HasOne
     */
    public function quiz()
    {
        return $this->hasOne(QuizModel::class, 'id', 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(AnswerModel::class, 'question_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'question_id', 'id');
    }
}