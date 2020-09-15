<?php
namespace App\SeriesISaw\Repositories;

use App\SeriesISaw\Repositories\Contracts\SeriesHistoryRepositoryInterface;
use App\SeriesISaw\Models\SeriesHistory;

class SeriesHistoryRepository extends BaseRepository implements SeriesHistoryRepositoryInterface {
	public function __construct(SeriesHistory $model)	{
		$this->model = $model;
	}
}
