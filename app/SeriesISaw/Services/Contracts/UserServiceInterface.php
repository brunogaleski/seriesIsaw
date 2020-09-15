<?php
namespace App\SeriesISaw\Services\Contracts;
/**
*
*/
interface UserServiceInterface {
	public function save(array $data);
	public function update(array $data, $id);
	public function getList();
	public function getUser($id);
	public function delete($id);
}
