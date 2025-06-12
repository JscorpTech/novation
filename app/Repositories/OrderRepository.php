<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
	 /**
     * @var Order
     */
    protected Order $order;

    /**
     * Order constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get all order.
     *
     * @return Order $order
     */
    public function all()
    {
        return $this->order->get();
    }

     /**
     * Get order by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->order->find($id);
    }

    /**
     * Save Order
     *
     * @param $data
     * @return Order
     */
     public function save(array $data)
    {
        return Order::create($data);
    }

     /**
     * Update Order
     *
     * @param $data
     * @return Order
     */
    public function update(array $data, int $id)
    {
        $order = $this->order->find($id);
        $order->update($data);
        return $order;
    }

    /**
     * Delete Order
     *
     * @param $data
     * @return Order
     */
   	 public function delete(int $id)
    {
        $order = $this->order->find($id);
        $order->delete();
        return $order;
    }
}
