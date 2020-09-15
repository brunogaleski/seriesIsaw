<?php
namespace App\SeriesISaw\Services;
/**
*
*/
use \Validator;
use App\SeriesISaw\Services\Contracts\seriesServiceInterface;
use App\SeriesISaw\Repositories\Contracts\SeriesRepositoryInterface;

class SeriesService implements SeriesServiceInterface {
	protected $series;

	public function __construct(SeriesRepositoryInterface $series)	{
		$this->series = $series;
	}

	public function save(array $data) 	{
		$validator = Validator::make($data, [
		    'name' => 'required|unique:series|min:3|max:60'
		]);

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->series->create($data);
		return true;
	}

	public function update(array $data, $id)  {
		$validator = Validator::make($data, [
			'name' => 'required|min:3|max:60'
		]);

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->series->update($data, $id);
		return true;
	}

	public function getList() {
		return $this->series->orderBy('name', 'asc')->paginate(5);
	}

	public function getSeries($id) {
		return $this->series->find($id);
	}

	public function delete($id)	{
		return $this->series->delete($id);
	}
}
