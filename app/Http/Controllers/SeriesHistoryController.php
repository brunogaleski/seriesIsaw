<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Models\User;
use App\SeriesISaw\Services\Contracts\SeriesHistoryServiceInterface;
use App\SeriesISaw\Models\Platform;
use App\SeriesISaw\Models\Series;
use App\SeriesISaw\Models\SeriesHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesHistoryController extends Controller {

    protected $seriesHistoryService;

    public function __construct(SeriesHistoryServiceInterface $seriesHistoryService) {
        $this->seriesHistoryService = $seriesHistoryService;
    }

    public function list() {
        $seriesHistoryList = Auth::user()->seriesHistory;

        return view('history.list')->with([
            'seriesHistoryList' => $seriesHistoryList
        ]);
    }

    public function store(Request $request) {
        $request->merge(['user_id' => $request->user()->id]);
        $result = $this->seriesHistoryService->save($request->except(['_token', '_method']));

        if ($result === true) {
            return redirect()->route('seriesHistory.new')
                ->with('success', 'Saved Successfully!');
        }

        return redirect()->route('seriesHistory.new')
            ->withInput()
            ->withErrors($result);
    }


    public function create() {
        $seriesList = Series::orderBy('name')->get();
        $platformList = Platform::orderBy('name')->get();

        return view('history.create', compact(['seriesList','platformList']));
    }

    public function edit($id) {
        $seriesList = Series::orderBy('name')->get();
        $platformList = Platform::orderBy('name')->get();

        return view('history.edit')->with([
            'seriesHistory' => $this->seriesHistoryService
                ->getSeriesHistory($id),
            'seriesList' => $seriesList,
            'platformList' => $platformList
        ]);
    }

    public function update(Request $request, $id) {
        $request->merge(['user_id' => $request->user()->id]);
        $result = $this->seriesHistoryService->update($request->except(['_token', '_method']), $id);

        if ($result === true) {
            return redirect()->route('seriesHistory.edit', $id)
                ->with('success', 'Updated Successfully!');
        }

        return redirect()->route('seriesHistory.edit', $id)
            ->withErrors($result)
            ->withInput();
    }

    public function delete(Request $request, $id) {
        $result = $this->seriesHistoryService->delete($id);
        $list = $this->seriesHistoryService->getList();

        if ($result === true) {
            return redirect()->route('seriesHistory.list')->with([
                'seriesHistoryList' => $list,
                'success' => 'Deleted Successfully'
            ]);
        }

        return redirect()->route('seriesHistory.list')
            ->withErrors($result)
            ->with('seriesHistoryList', $list)
            ->withInput();
    }
}
