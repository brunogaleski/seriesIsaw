<?php
namespace App\SeriesISaw\Services\Contracts;
/**
*
*/
interface SeriesServiceInterface {
	public function save(array $data);
	public function update(array $data, $id);
	public function getList();
	public function getSeries($id);
	public function delete($id);
}
