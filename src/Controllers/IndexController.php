<?php


namespace Quiz\Controllers;


use Quiz\ActiveUser;
use Quiz\Models\QuizModel;
use Quiz\Services\QuizService;

class IndexController extends BaseController
{
    /**
     * @var QuizService $quizService
     */
    private $quizService;

    public function __construct()
    {
        $this->quizService = new QuizService();

        parent::__construct();
    }

    public function index()
    {
        if (ActiveUser::isLoggedIn()) {
            try {
                $quizData = $this->quizService->getQuizRpcData();
            } catch (\Exception $exception) {
                die($exception->getMessage());
            }
            return $this->view('home', ['quizData' => $quizData]);
        }
        header('Location:/login');
    }

    public function about()
    {
        return $this->view('about');
    }
}