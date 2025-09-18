<?php

namespace App\Repositories\All\User;

use App\Repositories\Base\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get user with fitness/member data
     *
     * @param int $userId
     * @return mixed
     */
    public function getUserWithFitnessData($userId);

    /**
     * Get user with member relationship
     *
     * @param int $userId
     * @return mixed
     */
    public function getUserWithMember($userId);
}
