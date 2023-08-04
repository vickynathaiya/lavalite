<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\User\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var array
     */
    public function boot()
    {
        $this->fieldSearchable = config('users.user.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $provider = config('auth.guards.' . getenv('guard') . '.web.provider', 'users');

        return config("auth.providers.$provider.model", App\User::class);
    }

    /**
     * Attach a user to a team.
     *
     * @return string
     */
    function switch ($data) {
            $user = $this->model->find($data['user_id']);
            $user->team_id = $data['team_id'];
            $user->save();
            return $user;
    }

}
