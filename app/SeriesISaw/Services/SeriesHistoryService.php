<?php
namespace App\SeriesISaw\Services;
/**
*
*/

use Illuminate\Validation\Rule;
use \Validator;
use App\SeriesISaw\Services\Contracts\SeriesHistoryServiceInterface;
use App\SeriesISaw\Repositories\Contracts\SeriesHistoryRepositoryInterface;

class SeriesHistoryService implements SeriesHistoryServiceInterface {
	protected $seriesHistory;

	public function __construct(SeriesHistoryRepositoryInterface $seriesHistory)	{
		$this->seriesHistory = $seriesHistory;
	}

	public function save(array $data) 	{
        $messages = [
            'series_id.unique' => 'You already have this series in your history, please update the current record'
        ];
        $user_id = $data['user_id'];
        $series_id = $data['series_id'];

        $validator = Validator::make($data, [
            'series_id' => [
                'required',
                Rule::unique('series_history')->where(function ($query) use($user_id, $series_id) {
                    return $query->where('user_id', $user_id)->where('series_id', $series_id);
                }),
            ],
            'user_id' => 'required',
            'platform_id' => 'required',
            'current_season' => 'required',
            'current_episode' => 'required'
        ],
            $messages
        );

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->seriesHistory->create($data);
		return true;
	}

	public function update(array $data, $id)  {
        $messages = [
            'series_id.unique' => 'You already have this series in your history, please update the current record'
        ];
        $user_id = $data['user_id'];
        $series_id = $data['series_id'];

        $validator = Validator::make($data, [
            'series_id' => [
                'required',
                Rule::unique('series_history')->where(function ($query) use($user_id, $series_id) {
                    return $query->where('user_id', $user_id)->where('series_id', $series_id);
                })->ignore($id, 'series_history_id'),
            ],
            'user_id' => 'required',
            'platform_id' => 'required',
            'current_season' => 'required',
            'current_episode' => 'required'
        ],
            $messages
        );

		if ($validator->fails()) {
			return $validator->errors()->all();
		}

		$this->seriesHistory->update($data, $id, 'series_history_id');
		return true;
	}

	public function getList() {
		return $this->seriesHistory->orderBy('current_season', 'asc')->orderBy('current_episode', 'asc')->paginate(5);
	}

	public function getSeriesHistory($id) {
		return $this->seriesHistory->find($id);
	}

	public function delete($id)	{
		return $this->seriesHistory->delete($id);
	}
}
