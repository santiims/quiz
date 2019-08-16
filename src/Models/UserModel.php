<?php


namespace Quiz\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UserModel
 * @package Quiz\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @propery string $password
 * @property bool $user_level
 */
class UserModel extends BaseModel
{
    /**
     * @var string $table
     */
    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function attempts()
    {
        return $this->hasMany(AttemptModel::class, 'user_id', 'id');
    }

}