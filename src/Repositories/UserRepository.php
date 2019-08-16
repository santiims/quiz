<?php


namespace Quiz\Repositories;

use Quiz\Models\UserModel;

class UserRepository extends BaseRepository
{
    public function userExists(array $conditions = []): bool
    {
        return UserModel::query()->where($conditions)->exists();
    }

    public function check(array $data)
    {
        $entry = UserModel::query()->where(['email' => $data['email']])->first();
        if ($data['password'] != $entry['password']) {
            return false;
        }
        return true;
    }

    protected function getModelClass()
    {
        return UserModel::class;
    }

}