<?php
namespace App\Services;

use App\Models\ProductBundle;
use App\Repositories\ProductBundleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ProductBundleService
{
	/**
     * @var ProductBundleRepository $productBundleRepository
     */
    protected $productBundleRepository;

    /**
     * DummyClass constructor.
     *
     * @param ProductBundleRepository $productBundleRepository
     */
    public function __construct(ProductBundleRepository $productBundleRepository)
    {
        $this->productBundleRepository = $productBundleRepository;
    }

    /**
     * Get all productBundleRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->productBundleRepository->all();
    }

    /**
     * Get productBundleRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->productBundleRepository->getById($id);
    }

    /**
     * Validate productBundleRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return Bundle
     */
    public function save(array $data)
    {
        return $this->productBundleRepository->save($data);
    }

    /**
     * Update productBundleRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $productBundleRepository = $this->productBundleRepository->update($data, $id);
            DB::commit();
            return $productBundleRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete productBundleRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $productBundleRepository = $this->productBundleRepository->delete($id);
            DB::commit();
            return $productBundleRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }

}
