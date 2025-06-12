<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use PDO;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected OrderService $orderService;

    /**
     * DummyModel Constructor
     *
     * @param OrderService $orderService
     *
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return OrderResource::collection($this->orderService->getAll());
    }

    public function checkout(Request $request)
    {
        try {
            return OrderResource::make($this->orderService->checkout($request->user()->id));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function payment_verify(int $id)
    {
        try {
            return OrderResource::make($this->orderService->payment_verify($id));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(OrderRequest $request): OrderResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new OrderResource($this->orderService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): OrderResource
    {
        return OrderResource::make($this->orderService->getById($id));
    }

    public function update(OrderRequest $request, int $id): OrderResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new OrderResource($this->orderService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->orderService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
