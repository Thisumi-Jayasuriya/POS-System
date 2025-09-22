<?php

namespace App\Repositories\All\User;

use App\Models\User;
use App\Repositories\All\User\UserRepositoryInterface;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * __construct
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
