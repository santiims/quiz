<?php


namespace Quiz\Controllers;


use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Services\UserService;
use Quiz\Session;

class AdminController extends BaseController
{
    public function checkAdminStatus()
    {
        $userId = Session::getInstance()->getLoggedInUserId();
        $userRepository = new UserRepository();
        $user = $userRepository->one(['id' => $userId]);
        return (bool)$user->user_level;
    }

    public function newQuiz()
    {
        if ($this->checkAdminStatus()) {
            return $this->view('newquiz');
        }
        header('HTTP/1.1 404 Not Found');
        echo '<h1>404: Page not found</h1>';
        die;
    }

    public function saveQuizTitle()
    {
        if ($this->checkAdminStatus()) {
            $title = $this->input['title'];
            $quizRepository = new QuizRepository();
            $quiz = $quizRepository->create(['title' => $title]);
            Session::getInstance()->set('quiz_id', $quiz->id);
            redirect('/add-question');
            return;
        }
        header('HTTP/1.1 404 Not Found');
        echo '<h1>404: Page not found</h1>';
        die;
    }

    public function addQuestion()
    {
        if ($this->checkAdminStatus()) {
            return $this->view('addquestion');
        }
        header('HTTP/1.1 404 Not Found');
        echo '<h1>404: Page not found</h1>';
        die;
    }

    //TODO: clean this up
    public function saveQuestion()
    {
        if ($this->checkAdminStatus()) {
            $quizId = Session::getInstance()->get('quiz_id');
            $text = $this->input['text'];
            $answer1 = $this->input['answer1'];
            $correct1 = (isset($this->input['correct1'])) ? true : false;
            $answer2 = $this->input['answer2'];
            $correct2 = (isset($this->input['correct2'])) ? true : false;
            $answer3 = $this->input['answer3'];
            $correct3 = (isset($this->input['correct3'])) ? true : false;
            $answer4 = $this->input['answer4'];
            $correct4 = (isset($this->input['correct4'])) ? true : false;

            $questionRepository = new QuestionRepository();
            $question = $questionRepository->create(['text' => $text, 'quiz_id' => $quizId]);

            $answerRepository = new AnswerRepository();
            $answerRepository->create(['text' => $answer1, 'is_correct' => $correct1, 'question_id' => $question->id]);
            $answerRepository->create(['text' => $answer2, 'is_correct' => $correct2, 'question_id' => $question->id]);
            $answerRepository->create(['text' => $answer3, 'is_correct' => $correct3, 'question_id' => $question->id]);
            $answerRepository->create(['text' => $answer4, 'is_correct' => $correct4, 'question_id' => $question->id]);
            redirect('/add-question');
            return;
        }
        header('HTTP/1.1 404 Not Found');
        echo '<h1>404: Page not found</h1>';
        die;
    }

    public function finished()
    {
        if ($this->checkAdminStatus()) {
            Session::getInstance()->delete('quiz_id');
            redirect('/admin');
        }
        header('HTTP/1.1 404 Not Found');
        echo '<h1>404: Page not found</h1>';
        die;
    }
}