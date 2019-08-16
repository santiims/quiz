<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class QuizModel
 * @package Quiz\Models
 * @property int $id
 * @property string $title
 *
 * @property QuestionModel[] $questions
 * @property AttemptModel[] $attempts
 */
class QuizModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'quizzes';

    protected $fillable = ['title'];

    /**
     * @return HasMany
     */
    public function questions()
    {
        return $this->hasMany(QuestionModel::class, 'quiz_id', 'id');
    }

    public function attempts()
    {
        return $this->hasMany(AttemptModel::class, 'quiz_id', 'id');
    }
}