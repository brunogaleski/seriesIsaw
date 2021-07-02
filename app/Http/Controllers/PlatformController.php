<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Services\Contracts\PlatformServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlatformController extends Controller {

    protected $platformService;

    public function __construct(PlatformServiceInterface $platformService) {
        $this->platformService = $platformService;
    }

    public function list(): JsonResponse
    {
        return response()->json([ "platformsList" => $this->platformService->getList()]);
    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->platformService->save($request->except(['_token', '_method', 'XDEBUG_SESSION_START']));

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Saved Successfully!"]);
        }

        return response()->json(["status" => "failed", "message" => $result]);
    }


    public function update(Request $request, $id): JsonResponse {

        $result = $this->platformService
            ->update($request->except(['_token', '_method', 'XDEBUG_SESSION_START']), $id);

        if ($result === true) {
            return response()->json(["status" => "success", "message" => "Updated Successfully!"]);
        }

        return response()->json(["status" => "failed", "message" => $result]);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        $result = $this->platformService->delete($id);
        $list = $this->platformService->getList();

        if ($result === true) {
            return response()->json(["status" => "success", 'platformsList' => $list, "message" => 'Deleted Successfully']);
        }

        return response()->json(["status" => "failed", 'platformsList' => $list, "message" => $result]);
    }
}
