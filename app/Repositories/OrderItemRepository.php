<?php
namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository
{
	 /**
     * @var OrderItem
     */
    protected OrderItem $orderItem;

    /**
     * OrderItem constructor.
     *
     * @param OrderItem $orderItem
     */
    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    /**
     * Get all orderItem.
     *
     * @return OrderItem $orderItem
     */
    public function all()
    {
        return $this->orderItem->get();
    }

     /**
     * Get orderItem by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->orderItem->find($id);
    }

    /**
     * Save OrderItem
     *
     * @param $data
     * @return OrderItem
     */
     public function save(array $data)
    {
        return OrderItem::create($data);
    }

     /**
     * Update OrderItem
     *
     * @param $data
     * @return OrderItem
     */
    public function update(array $data, int $id)
    {
        $orderItem = $this->orderItem->find($id);
        $orderItem->update($data);
        return $orderItem;
    }

    /**
     * Delete OrderItem
     *
     * @param $data
     * @return OrderItem
     */
   	 public function delete(int $id)
    {
        $orderItem = $this->orderItem->find($id);
        $orderItem->delete();
        return $orderItem;
    }
}
