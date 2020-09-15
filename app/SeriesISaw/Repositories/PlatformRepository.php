<?php
namespace App\SeriesISaw\Repositories;

use App\SeriesISaw\Repositories\Contracts\PlatformRepositoryInterface;
use App\SeriesISaw\Models\Platform;

class PlatformRepository extends BaseRepository implements PlatformRepositoryInterface {
	public function __construct(Platform $model)	{
		$this->model = $model;
	}
}
