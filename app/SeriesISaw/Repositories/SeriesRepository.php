<?php
namespace App\SeriesISaw\Repositories;

use App\SeriesISaw\Repositories\Contracts\SeriesRepositoryInterface;
use App\SeriesISaw\Models\Series;

class SeriesRepository extends BaseRepository implements SeriesRepositoryInterface {
	public function __construct(Series $model)	{
		$this->model = $model;
	}
}
