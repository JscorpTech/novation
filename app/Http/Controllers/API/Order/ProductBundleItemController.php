<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ProductBundleItemRequest;
use App\Http\Resources\Order\ProductBundleItemResource;
use App\Services\ProductBundleItemService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBundleItemController extends Controller
{
    /**
     * @var ProductBundleItemService
     */
    protected ProductBundleItemService $productBundleItemService;

    /**
     * DummyModel Constructor
     *
     * @param ProductBundleItemService $productBundleItemService
     *
     */
    public function __construct(ProductBundleItemService $productBundleItemService)
    {
        $this->productBundleItemService = $productBundleItemService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ProductBundleItemResource::collection($this->productBundleItemService->getAll());
    }

    public function store(ProductBundleItemRequest $request): ProductBundleItemResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new ProductBundleItemResource($this->productBundleItemService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): ProductBundleItemResource
    {
        return ProductBundleItemResource::make($this->productBundleItemService->getById($id));
    }

    public function update(ProductBundleItemRequest $request, int $id): ProductBundleItemResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new ProductBundleItemResource($this->productBundleItemService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->productBundleItemService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
