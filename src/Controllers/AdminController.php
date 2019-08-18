<?php


namespace Quiz\Controllers;


use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Services\QuizService;
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

            $quizService = new QuizService();
            $quiz = $quizService->newQuiz($title);

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

    public function saveQuestion()
    {
        if ($this->checkAdminStatus()) {
            $quizService = new QuizService();
            $quizService->newQuestion($this->input);
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