<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CartRequest;
use App\Http\Resources\Order\CartResource;
use App\Services\CartService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    protected CartService $cartService;

    /**
     * DummyModel Constructor
     *
     * @param CartService $cartService
     *
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CartResource::collection($this->cartService->getAll());
    }

    public function store(CartRequest $request): CartResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new CartResource($this->cartService->save($request->validated(), $request->user()->id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): CartResource
    {
        return CartResource::make($this->cartService->getById($id));
    }

    public function update(CartRequest $request, int $id): CartResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new CartResource($this->cartService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->cartService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
