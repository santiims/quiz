<?php

use Quiz\Controllers\AdminController;
use Quiz\Controllers\QuizController;
use Quiz\Route;
use Quiz\Controllers\IndexController;
use Quiz\Controllers\AuthController;

return [
    '/' => new Route(IndexController::class, 'index'),
    '/about' => new Route(IndexController::class, 'about'),
    '/register' => new Route(AuthController::class, 'register'),
    '/registerPost' => new Route(AuthController::class, 'registerPost'),
    '/login' => new Route(AuthController::class, 'login'),
    '/loginCheck' => new Route(AuthController::class, 'loginCheck'),
    '/logout' => new Route(AuthController::class, 'logout'),
    '/quizzes/all' => new Route(QuizController::class, 'all'),
    '/quiz/start' => new Route(QuizController::class, 'start'),
    '/quiz/next-question' => new Route(QuizController::class, 'nextQuestion'),
    '/admin' => new Route(AuthController::class, 'admin'),
    '/new' => new Route(AdminController::class, 'newQuiz'),
    '/save-quiz-title' => new Route(AdminController::class, 'saveQuizTitle'),
    '/add-question' => new Route(AdminController::class, 'addQuestion'),
    '/save-question' => new Route(AdminController::class, 'saveQuestion'),
    '/finished' => new Route(AdminController::class, 'finished'),
];