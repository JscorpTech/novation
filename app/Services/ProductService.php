<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ProductService
{
    /**
     * @var ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * DummyClass constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all productRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->productRepository->all();
    }

    /**
     * Get productRepository by id.
     *
     * @param $id
     * @return Product
     */
    public function getById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    /**
     * Validate productRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->productRepository->save($data);
    }

    /**
     * Update productRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $productRepository = $this->productRepository->update($data, $id);
            DB::commit();
            return $productRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete productRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $productRepository = $this->productRepository->delete($id);
            DB::commit();
            return $productRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}
