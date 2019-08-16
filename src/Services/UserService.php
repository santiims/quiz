<?php


namespace Quiz\Services;

use Exception;
use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class UserService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function registerUser(array $data)
    {
        if ($this->repository->userExists(['email' => $data['email']])) {
            throw new Exception('User already exists');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->repository->create($data);
    }

    public function checkUser($data)
    {
        $user = $this->repository->one(['email' => $data['email']]);

        $doesUserExist = (bool)$user;
        $password_verify = password_verify($data['password'], $user->password ?? '');

        if (!$doesUserExist || !$password_verify) {
            throw new Exception('Credentials do not match');
        }

        $this->login($user);
    }

    public function isAdmin($data): bool
    {
        $user = $this->repository->one(['email' => $data['email']]);
        return $user->user_level;
    }

    protected function login(UserModel $user)
    {
        Session::getInstance()->setLoggedInUser($user);
    }

    public function validateData($data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $name = $data['name'];

        // TODO: better regex
        $emailPattern = "/^[A-Za-z0-9\.]{1,}@[A-Za-z0-9]{1,}[\.a-z]{2,}/";

        if (!preg_match($emailPattern, $email)) {
            throw new Exception('Nederīga epasta adrese');
        }

        $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
        if (!preg_match($passwordPattern, $password)) {
            throw new Exception('Parolei jābūt 8 rakstuzīmes garai ar vismaz vienu ciparu un vienu burtu');
        }

        if ($name == '') {
            throw new Exception('Vārds ir obligāts');
        }
    }
}