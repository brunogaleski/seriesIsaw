<?php
namespace App\SeriesISaw\Repositories;

/**
*
*/
class BaseRepository {
	protected $model;

	public function paginate($pages) {
		return $this->model->paginate($pages);
	}

	public function find($id) {
		return $this->model->find($id);
	}

	public function create(array $data) 	{
		return $this->model->create($data);
	}

	public function delete($id) {
		return $this->model
					->find($id)
					->delete();
	}

    public function update(array $data, $id, $customId = null) {
	    $idName = is_null($customId) ? 'id' : $customId;

        return $this->model
            ->where($idName, $id)
            ->update($data);
    }

	public function orderBy($col, $type) {
		return $this->model->orderBy($col, $type);
	}
}
