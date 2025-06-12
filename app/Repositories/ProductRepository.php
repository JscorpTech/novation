<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
	 /**
     * @var Product
     */
    protected Product $product;

    /**
     * Product constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get all product.
     *
     * @return Product $product
     */
    public function all()
    {
        return $this->product->get();
    }

     /**
     * Get product by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->product->find($id);
    }

    /**
     * Save Product
     *
     * @param $data
     * @return Product
     */
     public function save(array $data)
    {
        return Product::create($data);
    }

     /**
     * Update Product
     *
     * @param $data
     * @return Product
     */
    public function update(array $data, int $id)
    {
        $product = $this->product->find($id);
        $product->update($data);
        return $product;
    }

    /**
     * Delete Product
     *
     * @param $data
     * @return Product
     */
   	 public function delete(int $id)
    {
        $product = $this->product->find($id);
        $product->delete();
        return $product;
    }
}
