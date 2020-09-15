<?php
namespace App\SeriesISaw\Repositories\Contracts;
/**
*
*/
interface SeriesRepositoryInterface {
	public function find($id);
	public function paginate($pages);
	public function create(array $data);
	public function update(array $data, $id);
	public function delete($id);
}
