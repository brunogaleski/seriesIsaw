<?php
namespace App\SeriesISaw\Services\Contracts;
/**
*
*/
interface PlatformServiceInterface {
	public function save(array $data);
	public function update(array $data, $id);
	public function getList();
	public function getPlatforms($id);
	public function delete($id);
}
