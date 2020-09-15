<?php
namespace App\SeriesISaw\Repositories;

use App\SeriesISaw\Repositories\Contracts\UserRepositoryInterface;
use App\SeriesISaw\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface {
	public function __construct(User $model)	{
		$this->model = $model;
	}
}
