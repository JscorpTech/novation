<?php
namespace App\Services;

use App\Models\OrderItem;
use App\Repositories\OrderItemRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class OrderItemService
{
	/**
     * @var OrderItemRepository $orderItemRepository
     */
    protected $orderItemRepository;

    /**
     * DummyClass constructor.
     *
     * @param OrderItemRepository $orderItemRepository
     */
    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Get all orderItemRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->orderItemRepository->all();
    }

    /**
     * Get orderItemRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->orderItemRepository->getById($id);
    }

    /**
     * Validate orderItemRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->orderItemRepository->save($data);
    }

    /**
     * Update orderItemRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $orderItemRepository = $this->orderItemRepository->update($data, $id);
            DB::commit();
            return $orderItemRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete orderItemRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $orderItemRepository = $this->orderItemRepository->delete($id);
            DB::commit();
            return $orderItemRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }

}
