<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ProductBundleRequest;
use App\Http\Resources\Order\ProductBundleResource;
use App\Services\ProductBundleService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBundleController extends Controller
{
    /**
     * @var ProductBundleService
     */
    protected ProductBundleService $productBundleService;

    /**
     * DummyModel Constructor
     *
     * @param ProductBundleService $productBundleService
     *
     */
    public function __construct(ProductBundleService $productBundleService)
    {
        $this->productBundleService = $productBundleService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ProductBundleResource::collection($this->productBundleService->getAll());
    }

    public function store(ProductBundleRequest $request): ProductBundleResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new ProductBundleResource($this->productBundleService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): ProductBundleResource
    {
        return ProductBundleResource::make($this->productBundleService->getById($id));
    }

    public function update(ProductBundleRequest $request, int $id): ProductBundleResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new ProductBundleResource($this->productBundleService->update($request->validated(), $id));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->productBundleService->deleteById($id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
