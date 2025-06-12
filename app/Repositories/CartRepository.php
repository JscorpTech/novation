<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    /**
     * @var Cart
     */
    protected Cart $cart;

    /**
     * Cart constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get all cart.
     *
     * @return Cart $cart
     */
    public function all()
    {
        return $this->cart->get();
    }

    public function paginate()
    {
        return $this->cart->paginate();
    }
    /**
     * Get cart by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->cart->find($id);
    }

    /**
     * Save Cart
     *
     * @param $data
     * @return Cart
     */
    public function save(array $data)
    {
        return Cart::create($data);
    }

    /**
     * Update Cart
     *
     * @param $data
     * @return Cart
     */
    public function update(array $data, int $id)
    {
        $cart = $this->cart->find($id);
        $cart->update($data);
        return $cart;
    }

    /**
     * Delete Cart
     *
     * @param $data
     * @return Cart
     */
    public function delete(int $id)
    {
        $cart = $this->cart->find($id);
        $cart->delete();
        return $cart;
    }
}
