<?php
namespace App\SeriesISaw\Services;
/**
*
*/
use \Validator;
use App\SeriesISaw\Services\Contracts\PlatformServiceInterface;
use App\SeriesISaw\Repositories\Contracts\PlatformRepositoryInterface;

class PlatformService implements PlatformServiceInterface {
	protected $platform;

	public function __construct(PlatformRepositoryInterface $platform)	{
		$this->platform = $platform;
	}

	public function save(array $data) 	{
		$validator = Validator::make($data, [
		    'name' => 'required|unique:platform|min:3|max:60'
		]);

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->platform->create($data);
		return true;
	}

	public function update(array $data, $id)  {
		$validator = Validator::make($data, [
			'name' => 'required|min:3|max:60'
		]);

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->platform->update($data, $id);
		return true;
	}

	public function getList() {
		return $this->platform->orderBy('name', 'asc')->paginate(50);
	}

	public function getPlatforms($id) {
		return $this->platform->find($id);
	}

	public function delete($id)	{
		return $this->platform->delete($id);
	}
}
