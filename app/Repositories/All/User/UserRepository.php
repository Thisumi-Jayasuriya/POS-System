<?php

namespace App\Repositories\All\User;

use App\Models\User;
use App\Repositories\Base\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        User $model,
    ) {
        $this->model = $model;
    }

    /**
     * Get user with fitness/member data
     *
     * @param int $userId
     * @return User|null
     */
    public function getUserWithFitnessData($userId)
    {
        return $this->model->with(['member', 'roles', 'bodyMeasurements' => function ($query) {
            $query->latest('measurement_date');
        }])->find($userId);
    }

    /**
     * Get user with member relationship
     *
     * @param int $userId
     * @return User|null
     */
    public function getUserWithMember($userId)
    {
        return $this->model->with(['member', 'roles'])->find($userId);
    }
}
