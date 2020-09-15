<?php
namespace App\SeriesISaw\Services;
/**
*
*/
use \Validator;
use App\SeriesISaw\Services\Contracts\UserServiceInterface;
use App\SeriesISaw\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;


class UserService implements UserServiceInterface {
	protected $user;

	public function __construct(UserRepositoryInterface $user)	{
		$this->user = $user;
	}

	public function save(array $data) 	{
		$validator = Validator::make($data, [
		    'username' => 'required|unique:user|min:3|max:40',
            'password' => 'required|min:6|max:40'
		]);

        $data['password'] = Hash::make($data['password']);

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->user->create($data);
		return true;
	}

	public function update(array $data, $id)  {
		$validator = Validator::make($data, [
			'username' => 'required|min:3|max:40'
		]);

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->user->update($data, $id);
		return true;
	}

	public function getList() {
		return $this->user->orderBy('username', 'asc')->paginate(5);
	}

	public function getUser($id) {
		return $this->user->find($id);
	}

	public function delete($id)	{
		return $this->user->delete($id);
	}
}
