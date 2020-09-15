<?php
namespace App\SeriesISaw\Services\Contracts;
/**
*
*/
interface SeriesHistoryServiceInterface {
	public function save(array $data);
	public function update(array $data, $id);
	public function getList();
	public function getSeriesHistory($id);
	public function delete($id);
}
