<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Services\Contracts\SeriesServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeriesController extends Controller {

    protected $seriesService;

    public function __construct(SeriesServiceInterface $seriesService) {
        $this->seriesService = $seriesService;
    }

    public function list(): JsonResponse
    {
        return response()->json([ "seriesList" => $this->seriesService->getList()]);
    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->seriesService->save($request->except(['_token', '_method', 'XDEBUG_SESSION_START']));

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Saved Successfully!"]);
        }

        return response()->json(["status" => "failed", "message" => $result]);
    }


    public function update(Request $request, $id): JsonResponse {

        $result = $this->seriesService
            ->update($request->except(['_token', '_method', 'XDEBUG_SESSION_START']), $id);

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Updated Successfully!"]);
        }

        return response()->json(["status" => "failed", "message" => $result]);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        $result = $this->seriesService->delete($id);
        $list = $this->seriesService->getList();

        if ($result === true) {
            return response()->json(["status" => "success", 'seriesList' => $list, "message" => 'Deleted Successfully']);
        }

        return response()->json(["status" => "failed", 'seriesList' => $list, "message" => $result]);
    }
}
