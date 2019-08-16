<?php


namespace Quiz;


use Quiz\Models\UserModel;

class ActiveUser
{
    public static function isLoggedIn(): bool
    {
        return !is_null(Session::getInstance()->getLoggedInUserId());
    }

    public static function getLoggedInUser(): UserModel
    {
        $userId = Session::getInstance()->getLoggedInUserId();
        return UserModel::query()->where(['id' => $userId])->first();
    }
}