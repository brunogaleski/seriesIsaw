<?php
namespace App\SeriesISaw\Repositories\Contracts;
/**
*
*/
interface SeriesHistoryRepositoryInterface {
	public function find($id);
	public function paginate($pages);
	public function create(array $data);
	public function update(array $data, $id, $customId);
	public function delete($id);
}
