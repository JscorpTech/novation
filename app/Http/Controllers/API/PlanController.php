<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanResource;
use App\Services\PlanService;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{
    /**
     * @var PlanService
     */
    protected PlanService $planService;

    /**
     * DummyModel Constructor
     *
     * @param PlanService $planService
     *
     */
    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PlanResource::collection($this->planService->getAll());
    }

    public function store(PlanRequest $request): PlanResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new PlanResource($this->planService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): PlanResource
    {
        return PlanResource::make($this->planService->getById($id));
    }

    public function update(PlanRequest $request, int $id): PlanResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new PlanResource($this->planService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->planService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
