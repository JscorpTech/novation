<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Http\Resources\SubscribeResource;
use App\Services\SubscribeService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscribeController extends Controller
{
    /**
     * @var SubscribeService
     */
    protected SubscribeService $subscribeService;

    /**
     * DummyModel Constructor
     *
     * @param SubscribeService $subscribeService
     *
     */
    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return SubscribeResource::collection($this->subscribeService->getMyAll($request->user()->id));
    }

    public function store(SubscribeRequest $request): SubscribeResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new SubscribeResource($this->subscribeService->subscribe($request->validated(), $request->user()->id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id, Request $request): SubscribeResource
    {
        return SubscribeResource::make($this->subscribeService->getMyById($id, $request->user()->id));
    }

    public function update(SubscribeRequest $request, int $id): SubscribeResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new SubscribeResource($this->subscribeService->updateMy($request->validated(), $id, $request->user()->id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->subscribeService->deleteMyById($id, $request->user()->id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
