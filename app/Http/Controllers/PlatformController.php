<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Services\Contracts\PlatformServiceInterface;
use App\SeriesISaw\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller {

    protected $platformService;

    public function __construct(PlatformServiceInterface $platformService) {
        $this->platformService = $platformService;
    }

    public function list() {
        return view('platform.list')->with([
            'platformList' => $this->platformService->getList()
        ]);
    }

    public function store(Request $request) {
        $result = $this->platformService->save($request->except(['_token', '_method']));

        if ($result === true) {
            return redirect()->route('platform.new')
                ->with('success', 'Saved Successfully!');
        }

        return redirect()->route('platform.new')
            ->withInput()
            ->withErrors($result);
    }


    public function create() {
        return view('platform.create');
    }

    public function edit($id) {
        return view('platform.edit')->with([
            'platform' => $this->platformService
                ->getPlatforms($id)
        ]);
    }

    public function update(Request $request, $id) {

        $result = $this->platformService
            ->update($request->except(['_token', '_method']), $id);

        if ($result === true) {
            return redirect()->route('platform.edit', $id)
                ->with('success', 'Updated Successfully!');
        }

        return redirect()->route('platform.edit', $id)
            ->withErrors($result)
            ->withInput();
    }

    public function delete(Request $request, $id) {
        $result = $this->platformService->delete($id);
        $list = $this->platformService->getList();

        if ($result === true) {
            return redirect()->route('platform.list')->with([
                'platformList' => $list,
                'success' => 'Deleted Successfully'
            ]);
        }

        return redirect()->route('platform.list')
            ->withErrors($result)
            ->with('platformList', $list)
            ->withInput();
    }
}
