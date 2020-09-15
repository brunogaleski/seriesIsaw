<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Services\Contracts\SeriesServiceInterface;
use App\SeriesISaw\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller {

    protected $seriesService;

    public function __construct(SeriesServiceInterface $seriesService) {
        $this->seriesService = $seriesService;
    }

    public function list() {
        return view('series.list')->with([
            'seriesList' => $this->seriesService->getList()
        ]);
    }

    public function store(Request $request) {
        $result = $this->seriesService->save($request->except(['_token', '_method']));

        if ($result === true) {
            return redirect()->route('series.new')
                ->with('success', 'Saved Successfully!');
        }

        return redirect()->route('series.new')
            ->withInput()
            ->withErrors($result);
    }


    public function create() {
        return view('series.create');
    }

    public function edit($id) {
        return view('series.edit')->with([
            'series' => $this->seriesService
                ->getSeries($id)
        ]);
    }

    public function update(Request $request, $id) {

        $result = $this->seriesService
            ->update($request->except(['_token', '_method']), $id);

        if ($result === true) {
            return redirect()->route('series.edit', $id)
                ->with('success', 'Updated Successfully!');
        }

        return redirect()->route('series.edit', $id)
            ->withErrors($result)
            ->withInput();
    }

    public function delete(Request $request, $id) {
        $result = $this->seriesService->delete($id);
        $list = $this->seriesService->getList();

        if ($result === true) {
            return redirect()->route('series.list')->with([
                'seriesList' => $list,
                'success' => 'Deleted Successfully'
        ]);
        }

        return redirect()->route('series.list')
            ->withErrors($result)
            ->with('seriesList', $list)
            ->withInput();
    }
}
