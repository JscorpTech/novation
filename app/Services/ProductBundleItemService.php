<?php
namespace App\Services;

use App\Models\ProductBundleItem;
use App\Repositories\ProductBundleItemRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ProductBundleItemService
{
	/**
     * @var ProductBundleItemRepository $productBundleItemRepository
     */
    protected $productBundleItemRepository;

    /**
     * DummyClass constructor.
     *
     * @param ProductBundleItemRepository $productBundleItemRepository
     */
    public function __construct(ProductBundleItemRepository $productBundleItemRepository)
    {
        $this->productBundleItemRepository = $productBundleItemRepository;
    }

    /**
     * Get all productBundleItemRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->productBundleItemRepository->all();
    }

    /**
     * Get productBundleItemRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->productBundleItemRepository->getById($id);
    }

    /**
     * Validate productBundleItemRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->productBundleItemRepository->save($data);
    }

    /**
     * Update productBundleItemRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $productBundleItemRepository = $this->productBundleItemRepository->update($data, $id);
            DB::commit();
            return $productBundleItemRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete productBundleItemRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $productBundleItemRepository = $this->productBundleItemRepository->delete($id);
            DB::commit();
            return $productBundleItemRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }

}
