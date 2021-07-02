<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Services\Contracts\SeriesHistoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeriesHistoryController extends Controller
{

    protected $seriesHistoryService;

    public function __construct(SeriesHistoryServiceInterface $seriesHistoryService)
    {
        $this->seriesHistoryService = $seriesHistoryService;
    }

    public function list(): JsonResponse
    {
        return response()->json(["seriesHistoryList" => $this->seriesHistoryService->getList()]);
    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->seriesHistoryService->save($request->except(['_token', '_method', 'XDEBUG_SESSION_START']));

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Saved Successfully!"]);
        }

        return response()->json(["status" => "failed", "message" => $result]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $result = $this->seriesHistoryService->update($request->except(['_token', '_method', 'XDEBUG_SESSION_START']), $id);

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Updated Successfully!"]);
        }

        return response()->json(["status" => "failed", "message" => $result]);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        $result = $this->seriesHistoryService->delete($id);
        $list = $this->seriesHistoryService->getList();

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Deleted Successfully!", "seriesHistoryList" => $list]);
        }

        return response()->json(["status" => "failed", "message" => $result, "seriesHistoryList" => $list]);
    }
}
