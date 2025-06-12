<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromocodeRequest;
use App\Http\Resources\PromocodeResource;
use App\Services\PromocodeService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PromocodeController extends Controller
{
    /**
     * @var PromocodeService
     */
    protected PromocodeService $promocodeService;

    /**
     * DummyModel Constructor
     *
     * @param PromocodeService $promocodeService
     *
     */
    public function __construct(PromocodeService $promocodeService)
    {
        $this->promocodeService = $promocodeService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PromocodeResource::collection($this->promocodeService->getAll());
    }

    public function store(PromocodeRequest $request): PromocodeResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new PromocodeResource($this->promocodeService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): PromocodeResource
    {
        return PromocodeResource::make($this->promocodeService->getById($id));
    }

    public function update(PromocodeRequest $request, int $id): PromocodeResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new PromocodeResource($this->promocodeService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->promocodeService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
