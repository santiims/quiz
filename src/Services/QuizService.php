<?php


namespace Quiz\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Quiz\Exceptions\QuizException;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class QuizService
{
    const SESSION_KEY_CURRENT_ATTEMPT_ID = 'currentAttemptId';
    const SESSION_KEY_QUESTIONS_ANSWERED = 'questionsAnswered';
    /** @var QuizRepository $repository */
    private $repository;
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /** @var QuestionRepository $questionRepository */
    private $questionRepository;
    /** @var AnswerRepository $answerRepository */
    private $answerRepository;
    /** @var UserAnswerRepository $userAnswerRepository */
    private $userAnswerRepository;
    /** @var AttemptRepository $attemptRepository */
    private $attemptRepository;
    /** @var Session $session */
    private $session;

    public function __construct(QuizRepository $repository = null,
                                UserRepository $userRepository = null,
                                Session $session = null,
                                QuestionRepository $questionRepository = null,
                                AnswerRepository $answerRepository = null,
                                UserAnswerRepository $userAnswerRepository = null,
                                AttemptRepository $attemptRepository = null)
    {
        $this->repository = $repository ?: new QuizRepository();
        $this->userRepository = $userRepository ?: new UserRepository();
        $this->session = $session ?: Session::getInstance();
        $this->questionRepository = $questionRepository ?: new QuestionRepository();
        $this->answerRepository = $answerRepository ?: new AnswerRepository();
        $this->userAnswerRepository = $userAnswerRepository ?: new UserAnswerRepository();
        $this->attemptRepository = $attemptRepository ?: new AttemptRepository();
    }

    /**
     * @return array
     */
    public function getQuizRpcData()
    {
        $quizzes = $this->repository->all();

        $quizData = [];

        foreach ($quizzes as $quiz) {
            $questionCount = $this->questionRepository->count(['quiz_id' => $quiz->id]);

            $quizData[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'questionCount' => $questionCount,
            ];
        }

        return $quizData;
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @return Model|QuizModel
     * @throws Exception
     */
    public function start(int $userId, int $quizId)
    {
        $userExists = $this->userRepository->userExists(['id' => $userId]);

        if (!$userExists) {
            throw new QuizException('Unknown user');
        }

        $quiz = $this->getQuizById($quizId);

        $attempt = $this->attemptRepository->create([
            'user_id' => $userId,
            'quiz_id' => $quizId,
        ]);

        $this->session->set(self::SESSION_KEY_CURRENT_ATTEMPT_ID, $attempt->id);
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, 0);

        return $quiz;
    }

    public function getNextQuestion()
    {
        $attemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($attemptId);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED, -1);

        if ($questionsAnswered < 0) {
            throw new QuizException('Questions answered not set');
        }

        $question = $this->questionRepository->getQuestionByQuizIdAndOffset($attempt->quiz_id, $questionsAnswered);

        return $question;
    }

    public function getQuestionRpcData(QuestionModel $question)
    {
        $answerData = [];

        foreach ($question->answers as $answer) {
            $answerData[] = $this->getAnswerRpcData($answer);
        }

        return [
            'id' => $question->id,
            'text' => $question->text,
            'answers' => $answerData,
        ];
    }

    private function getAnswerRpcData(AnswerModel $answer)
    {
        return [
            'id' => $answer->id,
            'text' => $answer->text,
        ];
    }

    private function getQuizById(int $quizId)
    {
        $quiz = $this->repository->one(['id' => $quizId]);

        if (!$quiz) {
            throw new QuizException("Could not find quiz #$quizId");
        }

        return $quiz;
    }

    public function saveAnswer(int $answerId)
    {
        $answer =  $this->answerRepository->one(['id' => $answerId]);

        if (!$answer) {
            throw new QuizException('Answer does not exist');
        }

        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($currentAttemptId);

        $this->userAnswerRepository->create([
            'attempt_id' => $attempt->id,
            'question_id' => $answer->question_id,
            'answer_id' => $answer->id,
        ]);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED);
        $questionsAnswered++;
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, $questionsAnswered);

    }


    public function getResultData()
    {
        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($currentAttemptId);

        $correctAnswerCount = 0;

        foreach ($attempt->userAnswers as $userAnswer) {
            $correctAnswerCount += $userAnswer->answer->is_correct;
        }

        $this->session->delete(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $this->session->delete(self::SESSION_KEY_QUESTIONS_ANSWERED);

        return ['correctAnswerCount' => $correctAnswerCount];
    }

    /**
     * @param $attemptId
     * @return \Quiz\Models\AttemptModel|null
     * @throws Exception
     */
    private function getAttemptById($attemptId)
    {
        $attempt = $this->attemptRepository->one(['id' => $attemptId]);

        if (!$attempt) {
            throw new QuizException('Quiz has not been started!');
        }
        return $attempt;
    }

    public function newQuiz($title)
    {
        $quizRepository = new QuizRepository();
        return $quizRepository->create(['title' => $title]);
    }

    public function newQuestion($data)
    {
        $quizId = Session::getInstance()->get('quiz_id');
        $text = $data['text'];
        $questionRepository = new QuestionRepository();
        $question = $questionRepository->create(['text' => $text, 'quiz_id' => $quizId]);

        $answer1 = $data['answer1'];
        $correct1 = (isset($data['correct1'])) ? true : false;
        $answer2 = $data['answer2'];
        $correct2 = (isset($data['correct2'])) ? true : false;
        $answer3 = $data['answer3'];
        $correct3 = (isset($data['correct3'])) ? true : false;
        $answer4 = $data['answer4'];
        $correct4 = (isset($data['correct4'])) ? true : false;

        $answerRepository = new AnswerRepository();
        $answerRepository->create(['text' => $answer1, 'is_correct' => $correct1, 'question_id' => $question->id]);
        $answerRepository->create(['text' => $answer2, 'is_correct' => $correct2, 'question_id' => $question->id]);
        $answerRepository->create(['text' => $answer3, 'is_correct' => $correct3, 'question_id' => $question->id]);
        $answerRepository->create(['text' => $answer4, 'is_correct' => $correct4, 'question_id' => $question->id]);

        return $question;
    }
}