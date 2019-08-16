<?php


namespace Quiz\Controllers;

use Quiz\Repositories\UserRepository;
use Quiz\Services\QuizService;
use Quiz\Services\UserService;
use Quiz\Session;

class AuthController extends BaseController
{

    protected $registrationValidationRules = [
        'password' => 'required|confirmed|min:8',
        'email' => 'required|unique:users|email',
        'name' => 'required'
    ];

    public function register()
    {
        return $this->view('register');
    }

    public function registerPost()
    {
        $data = $this->input;

        if ($data['password'] !== $data['password_confirmation']) {
            $_SESSION['error'] = 'Passwords do not match';
            Session::getInstance()->addError('Passwords do not match');
            header('Location:/register');
            return;
        }

        $userService = new UserService();

        try {
            $userService->validateData($data);
        } catch (\Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/register');
        }

        try {
            $userService->registerUser($data);
        } catch (\Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/register');
        }
        Session::getInstance()->addMessage('successfully registered');
        redirect('/login');
    }

    public function login()
    {
        return $this->view('login');
    }

    public function loginCheck()
    {
        $data = $this->input;

        $userService = new UserService();
        try {
            $userService->checkUser($data);
        } catch (\Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/login');
        }

        if ($userService->isAdmin($data)) {
            redirect('/admin');
            return;
        }

        Session::getInstance()->addMessage('successfully logged in');
        redirect('/');
    }

    public function admin()
    {
        return $this->view('admin');
    }

    public function logout()
    {
        Session::getInstance()->setLoggedInUser(null);
        redirect('/');
    }
}