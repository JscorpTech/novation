<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderItemRequest;
use App\Http\Resources\Order\OrderItemResource;
use App\Services\OrderItemService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemController extends Controller
{
    /**
     * @var OrderItemService
     */
    protected OrderItemService $orderItemService;

    /**
     * DummyModel Constructor
     *
     * @param OrderItemService $orderItemService
     *
     */
    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return OrderItemResource::collection($this->orderItemService->getAll());
    }

    public function store(OrderItemRequest $request): OrderItemResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new OrderItemResource($this->orderItemService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): OrderItemResource
    {
        return OrderItemResource::make($this->orderItemService->getById($id));
    }

    public function update(OrderItemRequest $request, int $id): OrderItemResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new OrderItemResource($this->orderItemService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->orderItemService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
