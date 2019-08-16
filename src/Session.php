<?php


namespace Quiz;


use Quiz\Models\UserModel;

class Session
{
    const TYPE_ERROR = 'error';
    const TYPE_MESSAGE = 'message';
    const LOGGED_IN_USER = 'loggedInUser';
    protected static $instance;

    public function __construct()
    {
        session_start();
    }

    public static function getInstance(): Session               //Funkcija nodrošina, ka sesija paliek viena vienīga
    {                                                           //Pretējā gadījumā radītos jauna sesija pie katra redirect()
        if (!self::$instance) {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function addError(string $string)                    //Praktiski lieka funkcija, var aizstāt ar addMessages('error');
    {                                                           //                                          addMessages(self::TYPE_ERROR);
        $this->addMessage($string, self::TYPE_ERROR);
    }

    public function hasErrors(): bool
    {
        return (bool)$this->getErrors();
    }

    public function getErrors(bool $flush = false)
    {
        return $this->getMessages(self::TYPE_ERROR, $flush);
    }

    public function addMessage(string $string, string $type = self::TYPE_MESSAGE)
    {
        $messages = $this->get($type);
        $messages[] = $string;
        $this->set($type, $messages);
    }

    public function getMessages(string $type = self::TYPE_MESSAGE, bool $flush = false): array
    {
        $messages = $_SESSION[$type] ?? [];
        if ($flush) {
            $_SESSION[$type] = [];
        }
        return $messages;
    }

    public function setLoggedInUser(?UserModel $user)
    {
        $this->set(self::LOGGED_IN_USER, $user->id);
    }

    public function getLoggedInUserId(): ?int
    {
        return $this->get(self::LOGGED_IN_USER);
    }

    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }

}